<?php
require 'config.php';

function sendHttpRequestWithJson($url, $type, $postData) {
    wh_log('sendHttpRequestWithJson method: url=' . $url . ', type=' .$type . ', postData=' . json_encode($postData));
    // Setup cURL
    $handle = curl_init(XTRAPOWER_API_BASE_URL . $url);
    curl_setopt_array($handle, array(
        CURLOPT_POST => ($type === 'POST') ? TRUE : FALSE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            // 'Authorization: '.$authToken,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    // Send the request
    $response = curl_exec($handle);
    
    $responseCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
    wh_log('sendHttpRequestWithJson method: responseCode=' . $responseCode);

    // Check for errors
    if($response === FALSE){
        wh_log('sendHttpRequestWithJson method: responseError=' . curl_error($handle));
        die(curl_error($handle));
    }
    wh_log('sendHttpRequestWithJson method: responseData=' . $response);
    // Decode the response
    $responseData = json_decode($response, TRUE);
    
    // Close the cURL handler
    curl_close($handle);
    return $responseData;
}

function send_sms($mobile, $text) {
    $url = SMS_GATEWAY_URL; 
    $ch = curl_init();  
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_POST, false); 
    curl_setopt($ch, CURLOPT_URL, $url); 
    $result = curl_exec($ch);
    curl_close($ch);
    return $result;  
}

function createDbConnection() {
    // Create connection
    $connection = new mysqli(DATABSE_HOST, DATABSE_USERNAME, DATABSE_PASSWORD, DATABSE_NAME);
    // Check connection
    if ($connection->connect_error) {
      die("Connection failed: " . $connection->connect_error);
    }
    return $connection;
}

function generate_otp($mobile) {
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_otp_details where mobile = "' . $mobile . '" LIMIT 1';
    $result = $connection->query($sql);
    
    $otp = 0;
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $to_time = strtotime('now');
            $from_time = strtotime($row['sent_time']);
            if(round(abs($to_time - $from_time) / 60,2) > 15) {
                // generate new otp
                $otp = rand(1000, 9999);
                $sql = 'update xtrapower_otp_details set otp = "'.$otp.'", sent_time = now() where mobile = "'.$mobile.'"';
                $connection->query($sql);
            } else {
                $otp = $row['otp'];
            }
        }
    } else {
        $otp = rand(1000, 9999);
        $sql = 'insert into xtrapower_otp_details (mobile, otp, sent_time, insert_time) values ("'.$mobile.'", "'.$otp.'", now(), now())';
        $connection->query($sql);
    }
    $connection->close();

    // send otp to user
    $text = 'Your OTP is '.$otp.'. The OTP is valid for the next 15 minutes.';
    wh_log('Calling send_sms method with mobile: ' . $mobile . ' and text: ' . $text);
    // return send_sms($mobile, $text);
    // TODO:: need to configure sms url
    return 'success';
}

function verify_otp($mobile, $otp) {
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_otp_details where mobile = "' . $mobile . '" LIMIT 1';
    $result = $connection->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if($otp != $row['otp']) {
                return 'invalid otp...';
            } else {
                $to_time = strtotime('now');
                $from_time = strtotime($row['sent_time']);
                if(round(abs($to_time - $from_time) / 60,2) > 15) {
                    return 'expired otp...';
                } else {
                    return 'success';
                }
            }
        }
    } else {
        return 'invalid otp...';
    }
    $connection->close();
}

function insertNewsEvents($headline, $linkText, $linkUrl, $newsId) {
    $connection = createDbConnection();

    $isUpdated = false;
    if($newsId != '0') {
        $sql = 'select * from xtrapower_news_events where id = "' . $newsId . '" LIMIT 1';
        $result = $connection->query($sql);
        if ($result->num_rows > 0) {
            $sql = 'update xtrapower_news_events set headline="'.$headline.'", link_text="'.$linkText.'", link_url="'.$linkUrl.'", updation_time=now() where id='.$newsId;
            $connection->query($sql);
            $isUpdated = true;
        }
    }
    if($isUpdated === false) {
        $sql = 'insert into xtrapower_news_events (headline, link_text, link_url, insertion_time, updation_time, status) values ("'.$headline.'", "'.$linkText.'", "'.$linkUrl.'", now(), now(), 1)';
        $connection->query($sql);
    }
    $connection->close();
}

function fetchAllNewsEvents() {
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_news_events';
    $result = $connection->query($sql);

    $news = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $temp = new stdClass();
            $temp->id = $row['id'];
            $temp->headline = $row['headline'];
            $temp->linkText = $row['link_text'];
            $temp->linkUrl = $row['link_url'];
            $temp->status = $row['status'];
            $temp->insertionTime = $row['insertion_time'];
            $temp->updationTime = $row['updation_time'];
            array_push($news, $temp);
        }
    }
    $connection->close();
    return $news;
}

function updateNewsEventStatus($newsId) {
    $connection = createDbConnection();
    $sql = 'update xtrapower_news_events set status=(CASE WHEN status = 1 THEN 0 ELSE 1 END), updation_time=now() where id='.$newsId;
    $connection->query($sql);
    $connection->close();
}

function submit_customer_details($mobile, $formnumber, $appdate, $requirementCard) {
    wh_log('inside function.php submit_customer_details method with formnumber:'.$formnumber.', appdate:'.$appdate.' and requirementCard:'.$requirementCard);
    
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formnumber.'" LIMIT 1';
    $result = $connection->query($sql);

    $josndata->form_number = $formnumber;
    $josndata->application_date = $appdate;
    $josndata->customer_requirement = $requirementCard;

    if ($result->num_rows > 0) {
        // update entry
        $sql = "update xtrapower_enroll_now set customer_details='".json_encode($josndata)."', updation_time=now() where mobile='".$mobile."' and form_number='".$formnumber."'";
        $connection->query($sql);
    } else {
        // insert new entry
        $sql = "insert into xtrapower_enroll_now (mobile, form_number, customer_details, status, insertion_time, updation_time) values ('".$mobile."', '".$formnumber."', '".json_encode($josndata)."', 0, now(), now())";
        $connection->query($sql);
    }
    $connection->close();
    return 'success';
}

function customer_card_details($mobile, $formNumber, $entityName, $nameOnCard, $constitution, $panNumber, $gstNumber, $panPath, $gstPath){
    wh_log('inside customer_card_details method with mobile:'. $mobile .', formNumber:'. $formNumber .', entityName:'. $entityName
            .', nameOnCard:'. $nameOnCard.', constitution:'.$constitution.', panNumber:'.$panNumber.', gstNumber:'.$gstNumber
            .', panPath:'.$panPath .', gstPath:'. $gstPath);
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $josndata->entity_name = $entityName;
        $josndata->name_on_card = $nameOnCard;
        $josndata->constitution = $constitution;
        $josndata->pan_number = $panNumber;
        $josndata->gst_number = $gstNumber;
        $josndata->pan_file = $panPath;
        $josndata->gst_file = $gstPath;


        $sql = "update xtrapower_enroll_now set customer_card_details='".json_encode($josndata)."', updation_time=now() where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}

function customer_address_details($mobile, $formNumber, $permanent_pincode, $comm_pincode, $permanent_location, $comm_location, 
                        $permanent_add, $comm_add, $permanent_city, $comm_city, $permanent_district, $comm_district,
                        $permanent_state, $comm_state){

    wh_log('inside customer_address_details method with mobile:'. $mobile .', formNumber:'. $formNumber .', permanent_pincode: '.$permanent_pincode.', permanent_location: '.$permanent_location.', permanent_add: '.$permanent_add.', permanent_city:'.$permanent_city.', permanent_district:'.$permanent_district.', permanent_state:'.$permanent_state.', comm_pincode: '.$comm_pincode.', comm_location: '.$comm_location.', comm_add: '.$comm_add.', comm_city:'.$comm_city.', comm_district:'.$comm_district.', comm_state:'.$comm_state);
    
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $josndata->permanent->pincode = $permanent_pincode;
        $josndata->permanent->location = $permanent_location;
        $josndata->permanent->address = $permanent_add;
        $josndata->permanent->city = $permanent_city;
        $josndata->permanent->district = $permanent_district;
        $josndata->permanent->state = $permanent_state;

        $josndata->communication->pincode = $comm_pincode;
        $josndata->communication->location = $comm_location;
        $josndata->communication->address = $comm_add;
        $josndata->communication->city = $comm_city;
        $josndata->communication->district = $comm_district;
        $josndata->communication->state = $comm_state;
        
        $sql = "update xtrapower_enroll_now set customer_address='".json_encode($josndata)."', updation_time=now() where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}
function customer_contact_details($mobile, $formNumber, $title, $name, $mobile1, $email_add, $fleet_size, $area, $nominee){
    wh_log('inside customer_contact_details method with mobile:'. $mobile .', formNumber:'. $formNumber .', title: '.$title.', name: '.$name.', mobile1: '.$mobile1.', email_add:'.$email_add.', fleet_size:'.$fleet_size.', area:'.$area.', nominee: '.$nominee);
    
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $josndata->title = $title;
        $josndata->name = $name;
        $josndata->mobile = $mobile1;
        $josndata->email_add = $email_add;
        $josndata->fleet_size = $fleet_size;
        $josndata->area = $area;
        $josndata->nominee = $nominee;
        
        $sql = "update xtrapower_enroll_now set key_official_contact_details='".json_encode($josndata)."', updation_time=now() where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}

function non_fleet_card_details_submit($mobile, $formNumber, $cards) {
    wh_log('inside card_details_submit method with mobile:'. $mobile .', formNumber:'. $formNumber .', cards: '.$cards);
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $card_details = array();
        
        $josndata->cards = (int)$cards;
        $josndata->card_details = $card_details;

        $status = 1;
        
        $sql = "update xtrapower_enroll_now set card_creation='".json_encode($josndata)."', updation_time=now(), status = ".$status." where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}

function card_details_submit($mobile, $formNumber, $cards, $count, $vehicle_number, $vehicle_make, $vehicle_type, $year_of_reg, $rcPath){
    wh_log('inside card_details_submit method with mobile:'. $mobile .', formNumber:'. $formNumber .', cards: '.$cards.', count: '.$count.', vehicle_number: '.$vehicle_number.', vehicle_make:'.$vehicle_make.', vehicle_type:'.$vehicle_type.', year_of_reg:'.$year_of_reg.', rcPath: '.$rcPath);
    
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $card_details = array();
        if($row = $result->fetch_assoc()) {
            if(empty($row['card_creation']) === false) {
                $data = json_decode($row['card_creation'], TRUE);
                $card_details = $data['card_details'];
            }
        }
        
        $card->vehicle_number = $vehicle_number;
        $card->vehicle_make = $vehicle_make;
        $card->vehicle_type = $vehicle_type;
        $card->year_of_reg = $year_of_reg;
        $card->rc_doc = $rcPath;
        $card_details[$count] = $card;

        $josndata->cards = (int)$cards;
        $josndata->card_details = $card_details;

        $status = ((int)$count == (int)$cards - 1) ? 1 : 0;
        
        $sql = "update xtrapower_enroll_now set card_creation='".json_encode($josndata)."', updation_time=now(), status = ".$status." where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}


function generateRandomString($length = 6) {
    wh_log('inside generateRandomString method with length= '. $length);

    $characters = '0123456789AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz-_/';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    wh_log('inside generateRandomString method: generated random number= '. $randomString);

    // check if already exists in table
    $connection = createDbConnection();
    $sql = 'select count(1) count from xtrapower_enroll_now where form_number = "' . $randomString . '" LIMIT 1';
    $result = $connection->query($sql);
    if($row = $result->fetch_assoc()) {
        if($row['count'] > 0) {
            wh_log('inside generateRandomString method: generated random number already exists in table, so calling method again');
            $connection->close();
            generateRandomString($length);
        }
    }
    return $randomString;
}

function fetchUserInformation($mobile) {
    wh_log('inside fetchUserInformation method with mobile= '. $mobile);
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" LIMIT 1';
    $result = $connection->query($sql);

    $response = new stdClass();
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {
            $response->status = 'success';
            // mobile, form_number, customer_details, customer_card_details, customer_address, key_official_contact_details, application_form, card_creation, status, insertion_time, updation_time
            $response->mobile = $row['mobile'];
            $response->form_number = $row['form_number'];

            // {"form_number": "123456", "application_date": "2021-03-19", "customer_requirement": "Fleet"}
            $response->customer_details = json_decode($row['customer_details']);

            // {"entity_name":"PK Online","name_on_card":"Ramesh Kumar","constitution":"1602","pan_number":"DHWPK2857K","gst_number":"06AAECP4462C1ZP","pan_file":"uploads/dhwpk2857k.jpeg","gst_file":"uploads/06aaecp4462c1zp.jpeg"}
            $response->customer_card_details = json_decode($row['customer_card_details']);

            // {"permanent":{"pincode":"124111","location":"Near Rest House","address":"Vpo Madina Korsan","city":"Rohtak","district":"Rohtak","state":"Haryana"},"communication":{"pincode":"124111","location":"Near Rest House","address":"Vpo Madina Korsan","city":"Rohtak","district":"Rohtak","state":"Haryana"}}
            $response->customer_address = json_decode($row['customer_address']);

            // {"title":"Mr.","name":"Ramesh Kumar","mobile":"8685898984","email_add":"rkjangra195@gmail.com","fleet_size":"5","area":"Haryana, Rohtak, Rohtak","nominee":"Santosh"}
            $response->key_official_contact_details = json_decode($row['key_official_contact_details']);

            $response->application_form = json_decode($row['application_form']);

            // {"cards":2,"card_details":[{"vehicle_number":"dfghjkl","vehicle_make":"dfghjkiuyf","vehicle_type":"fdhfgkhjioo","year_of_reg":"2020","rc_doc":"uploads/dfghjkl.jpeg"},{"vehicle_number":"hr26cz7331","vehicle_make":"dfghjkiuyf","vehicle_type":"fdhfgkhjioo","year_of_reg":"2020","rc_doc":"uploads/hr26cz7331.jpeg"}]}
            $response->card_creation = json_decode($row['card_creation']);
        }
    } else {
        $response->status = 'fail';
    }
    $connection->close();
    return json_encode($response);
}

require_once 'fpdf-crud.php';
function generate_application_form($mobile, $formNumber) {
    wh_log('inside generate_application_form method with mobile= '. $mobile. ', and formNumber='.$formNumber);
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);

    $response = new stdClass();
    if ($result->num_rows > 0) {
        if($row = $result->fetch_assoc()) {
            $response->status = 'success';
            $response->application_form_url = generateApplicationForm($row);
        }
    } else {
        $response->status = 'fail';
    }
    $connection->close();
    return json_encode($response);
}

function combineApplicationFormWithPanAndGst($form_number, $application_form, $pan_file, $gst_file) {
    wh_log('inside combineApplicationFormWithPanAndGst method with application_form= '. $application_form. ', and pan_file='.$pan_file. ', and gst_file='.$gst_file);

    return addImageToPdf($form_number, $application_form, $pan_file, $gst_file);
}

function save_application_form($mobile, $formNumber, $applicationFormPath) {
    wh_log('inside save_application_form method with mobile:'. $mobile .', formNumber:'. $formNumber .', applicationFormPath: '.$applicationFormPath);
    
    $connection = createDbConnection();
    $sql = 'select * from xtrapower_enroll_now where status = 0 and mobile = "' . $mobile . '" and form_number="'.$formNumber.'" LIMIT 1';
    $result = $connection->query($sql);
    if ($result->num_rows > 0) {

        $josndata->application_form = $applicationFormPath;
        
        $sql = "update xtrapower_enroll_now set application_form='".json_encode($josndata)."', updation_time=now(), status = 0 where mobile='".$mobile."' and form_number='".$formNumber."'";
        $connection->query($sql);
        $connection->close();
        return 'success';
    } else {
        return 'fail';
    }
}

function generateUserKeyForXP() {
    if (isset($_SESSION['USER_KEY']) && empty($_SESSION['USER_KEY']) === false) {
        $userKey = $_SESSION['USER_KEY'];
    } else {
        $data = array (
            'UserName'      => XTRAPOWER_API_USERNAME,
            'Password'      => XTRAPOWER_API_PASSWORD,
            'AgentInfo'     => XTRAPOWER_API_AGENT_INFO
        );
        $response = sendHttpRequestWithJson(XTRAPOWER_API_AUTHENTICATE_USER, 'POST', $data);
        if($response['StatusCode'] != "0") {
            die('Failed to Authenticate user...');
        }
        $userKey = $response['UserKey'];
        $_SESSION['USER_KEY'] = $userKey;
    }
    return $userKey;
}

?>