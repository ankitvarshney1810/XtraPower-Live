<?php
require 'functions.php';

$action = isset($_POST['action']) ? $_POST["action"] : '';
if(empty($action)) {
    die('Invalid Action!');
}
wh_log('Request on API Controller with action: ' . $action);
$valid_extensions = array('jpeg', 'jpg', 'pdf');

switch ($action) {

    case 'send-otp':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        wh_log('API Controller with mobile: ' . $mobile);
        if(empty($mobile)) 
            die('Invalid mobile number...');
        echo generate_otp($mobile);
        break;

    case 'verify-otp':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $otp = isset($_POST['otp']) ? $_POST["otp"] : '';
        wh_log('API Controller with mobile: ' . $mobile . ' and otp: ' . $otp);
        if(empty($mobile) || empty($otp)) 
            die('invalid otp...');
        if($otp == '0000')  // TODO:: Just for testing
            die('success');
        echo verify_otp($mobile, $otp);
        break;
    
    case 'form-number-validation':
        $applicationNumber = isset($_POST['applicationNumber']) ? $_POST["applicationNumber"] : '';
        wh_log('API Controller with Form Number: ' . $applicationNumber);
        if(empty($applicationNumber)) 
            die('Invalid Form Number...');
        // Curl Request to API API_FORM_NUMBER_VALIDATION
        $data = array (
            'UserKey'       => 'RrrXPrAsVbQhxnz8afrpubUXTiIj7eo8t4cGJHjz+3A=',
            'AgentInfo'     => 'TESTAGENT',
            'CustomerId'    => '1000230059',
            'FormNumber'    => $applicationNumber
        );
        sendHttpRequestWithJson(API_FORM_NUMBER_VALIDATION, 'POST', $data);

        break;

    case 'submit-customer-details':
        $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
        $formnumber = isset($_POST['formnumber']) ? $_POST['formnumber'] : '';
        $appdate = isset($_POST['appdate']) ? $_POST['appdate'] : '';
        $requirementCard = isset($_POST['requirementCard']) ? $_POST["requirementCard"] : '';
        wh_log('API Controller with formnumber: ' . $formnumber . ' and appdate: ' . $appdate . 'and requirementCard: ' . $requirementCard);
        
        if(empty($mobile) || empty($formnumber) || empty($appdate) || empty($requirementCard)) 
            die('invalid customer details...');
        echo submit_customer_details($mobile, $formnumber, $appdate, $requirementCard);
        break;

    case 'customer-card-details':
        
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';
        $entityName = isset($_POST['entityName']) ? $_POST["entityName"] : '';
        $nameOnCard = isset($_POST['nameOnCard']) ? $_POST["nameOnCard"] : '';
        $constitution = isset($_POST['constitution']) ? $_POST["constitution"] : '';
        $panNumber = isset($_POST['panNumber']) ? $_POST["panNumber"] : '';
        $gstNumber = isset($_POST['gstNumber']) ? $_POST["gstNumber"] : '';

        $panNumberImgUrl = isset($_POST['panNumberImgUrl']) ? $_POST["panNumberImgUrl"] : '';
        $gstNumberImgUrl = isset($_POST['gstNumberImgUrl']) ? $_POST["gstNumberImgUrl"] : '';
        
        if(empty($mobile) || empty($formNumber) || empty($entityName) || empty($nameOnCard) || empty($constitution) || 
                empty($panNumber) || empty($gstNumber)) 
            die('some of parameters missing...');

        $uploadPath = 'uploads/';
        if(empty($panNumberImgUrl) === false) {
            $panPath = $panNumberImgUrl;
        } else {
            $panImg = $_FILES['panNumberImg'];
            $panExt = strtolower(pathinfo($panImg['name'], PATHINFO_EXTENSION));
            if(in_array($panExt, $valid_extensions) === false) {
                die('Only '. implode(', ', $valid_extensions).' files allowed in PAN!');
            }
            $panPath = $uploadPath. strtolower($panNumber.'.'.$panExt);
            if(move_uploaded_file($panImg['tmp_name'], $panPath)) {
                wh_log('API Controller Pan uploaded successfully :' .$panPath);
            }
        }

        if(empty($gstNumberImgUrl) === false) {
            $panPath = $gstNumberImgUrl;
        } else {
            $gstImg = $_FILES['gstNumberImg'];
            $gstExt = strtolower(pathinfo($gstImg['name'], PATHINFO_EXTENSION));
            if(in_array($gstExt, $valid_extensions) === false) {
                die('Only '. implode(', ', $valid_extensions).' files allowed in GST!');
            }
            $gstPath = $uploadPath. strtolower($gstNumber.'.'.$gstExt);
            if(move_uploaded_file($gstImg['tmp_name'], $gstPath)) {
                wh_log('API Controller Gst uploaded successfully :' .$gstPath);
            }
        }
        wh_log('panPath:' .$panPath . ', gstPath: ' . $gstPath);
        
        echo customer_card_details($mobile, $formNumber, $entityName, $nameOnCard, $constitution, $panNumber, $gstNumber, $panPath, $gstPath);
        break;

    case 'customer-address':

        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';

        $permanent_pincode = isset($_POST['permanent_pincode']) ? $_POST["permanent_pincode"] : '';
        $permanent_location = isset($_POST['permanent_location']) ? $_POST["permanent_location"] : '';
        $permanent_add = isset($_POST['permanent_add']) ? $_POST["permanent_add"] : '';
        $permanent_city = isset($_POST['permanent_city']) ? $_POST["permanent_city"] : '';
        $permanent_district = isset($_POST['permanent_district']) ? $_POST["permanent_district"] : '';
        $permanent_state = isset($_POST['permanent_state']) ? $_POST["permanent_state"] : '';

        $comm_pincode = isset($_POST['comm_pincode']) ? $_POST["comm_pincode"] : '';
        $comm_location = isset($_POST['comm_location']) ? $_POST["comm_location"] : '';
        $comm_add = isset($_POST['comm_add']) ? $_POST["comm_add"] : '';
        $comm_city = isset($_POST['comm_city']) ? $_POST["comm_city"] : '';
        $comm_district = isset($_POST['comm_district']) ? $_POST["comm_district"] : '';
        $comm_state = isset($_POST['comm_state']) ? $_POST["comm_state"] : '';

        wh_log('API Controller with action: '.$action.', values are [permanent_pincode: '.$permanent_pincode.', permanent_location: '.$permanent_location.', permanent_add: '.$permanent_add.', permanent_city:'.$permanent_city.', permanent_district:'.$permanent_district.', permanent_state:'.$permanent_state.', comm_pincode: '.$comm_pincode.', comm_location: '.$comm_location.', comm_add: '.$comm_add.', comm_city:'.$comm_city.', comm_district:'.$comm_district.', comm_state:'.$comm_state.']');

        if(empty($permanent_pincode) || empty($comm_pincode) 
                    || empty($permanent_location) || empty($comm_location)
                    || empty($permanent_add) || empty($comm_add)
                    || empty($permanent_city) || empty($comm_city)
                    || empty($permanent_district) || empty($comm_district)
                    || empty($permanent_state) || empty($comm_state)) 
            die('invalid customer address details...');
        
        echo customer_address_details($mobile, $formNumber, $permanent_pincode, $comm_pincode, $permanent_location, $comm_location, 
                    $permanent_add, $comm_add, $permanent_city, $comm_city, $permanent_district, $comm_district,
                    $permanent_state, $comm_state);
            break;

    case 'customer-contact-details':

        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';

        $title = isset($_POST['title']) ? $_POST["title"] : '';
        $name = isset($_POST['name']) ? $_POST["name"] : '';
        $mobile1 = isset($_POST['mobile1']) ? $_POST["mobile1"] : '';
        $email_add = isset($_POST['email_add']) ? $_POST["email_add"] : '';
        $fleet_size = isset($_POST['fleet_size']) ? $_POST["fleet_size"] : '';
        $area = isset($_POST['area']) ? $_POST["area"] : '';
        $nominee = isset($_POST['nominee']) ? $_POST["nominee"] : '';

        wh_log('API Controller with action: '.$action.', values are [title: '.$title.', name: '.$name.', mobile1: '.$mobile1.', email_add:'.$email_add.', fleet_size:'.$fleet_size.', area:'.$area.', nominee: '.$nominee.']');

        if(empty($title) || empty($name) || empty($mobile1) || empty($email_add) || empty($fleet_size) || empty($area) || empty($nominee)) 
            die('invalid customer contact details...');
    
        echo customer_contact_details($mobile, $formNumber, $title, $name, $mobile1, $email_add, $fleet_size, $area, $nominee);
        break;

    case 'generate-form-number':
        echo generateRandomString(6);
        break;

    case 'enroll-now-information':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        wh_log('API Controller with mobile: ' . $mobile);
        if(empty($mobile)) 
            die('invalid mobile number...');
        echo fetchUserInformation($mobile);
        break;

    case 'card-creation-submit':
        
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';
        $cards = isset($_POST['cards']) ? $_POST["cards"] : '';

        $isFleetCard = isset($_POST['isFleetCard']) ? $_POST["isFleetCard"] : '';
        if($isFleetCard == 'No') {
            echo non_fleet_card_details_submit($mobile, $formNumber, $cards);
        } else {
            $count = isset($_POST['count']) ? $_POST["count"] : '';
            $vehicle_number = isset($_POST['vehicle_number']) ? $_POST["vehicle_number"] : '';
            $vehicle_make = isset($_POST['vehicle_make']) ? $_POST["vehicle_make"] : '';
            $vehicle_type = isset($_POST['vehicle_type']) ? $_POST["vehicle_type"] : '';
            $year_of_reg = isset($_POST['year_of_reg']) ? $_POST["year_of_reg"] : '';
    
            $vehicle_rc_url = isset($_POST['vehicle_rc_url']) ? $_POST["vehicle_rc_url"] : '';
            
            wh_log('API Controller with action: '.$action.', values are [cards: '.$cards.', count: '.$count.', vehicle_number: '.$vehicle_number.', vehicle_make:'.$vehicle_make.', vehicle_type:'.$vehicle_type.', year_of_reg:'.$year_of_reg.', vehicle_rc: '.$vehicle_rc.']');
    
            if(empty($cards) || $count == '' || (int)$cards == 0 || empty($vehicle_number) || empty($vehicle_make) || empty($vehicle_type) || empty($year_of_reg)) 
                die('invalid card details for card number '.((int)$count + 1).': '.$vehicle_number.'...');
    
            if(empty($vehicle_rc_url) === false) {
                $rcPath = $vehicle_rc_url;
            } else {
                $uploadPath = 'uploads/';
            
                $rcImg = $_FILES['vehicle_rc'];
                $rcExt = strtolower(pathinfo($rcImg['name'], PATHINFO_EXTENSION));
                if(in_array($rcExt, $valid_extensions) === false) {
                    die('Only '. implode(', ', $valid_extensions).' files allowed in RC doc!');
                }
                $rcPath = $uploadPath. strtolower($vehicle_number.'.'.$rcExt);
                if(move_uploaded_file($rcImg['tmp_name'], $rcPath)) {
                    wh_log('API Controller RC uploaded successfully :' .$rcPath);
                }
            }
            echo card_details_submit($mobile, $formNumber, $cards, $count, $vehicle_number, $vehicle_make, $vehicle_type, $year_of_reg, $rcPath);
        }
        break;

    case 'application-form-creation':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formnumber']) ? $_POST["formnumber"] : '';
        
        wh_log('API Controller with action: '.$action.', values are [mobile: '.$mobile.', formnumber: '.$formNumber.']');

        if(empty($mobile) || empty($formNumber)) 
            die('invalid mobile or formnumber...');

        echo generate_application_form($mobile, $formNumber);
        break;

    case 'application-form-upload':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';

        $signedApplicationForm1 = isset($_POST['signedApplicationForm1']) ? $_POST["signedApplicationForm1"] : '';
        
        wh_log('API Controller with action: '.$action.', values are [mobile: '.$mobile.', formnumber: '.$formNumber.']');

        if(empty($mobile) || empty($formNumber)) 
            die('invalid mobile or formnumber...');

        if(empty($signedApplicationForm1) === false) {
            $applicationFormPath = $signedApplicationForm1;
        } else {
            $uploadPath = 'applications/';
        
            $applicationForm = $_FILES['signedApplicationForm'];
            $applicationFormExt = strtolower(pathinfo($applicationForm['name'], PATHINFO_EXTENSION));
            if($applicationFormExt != 'pdf') {
                die('Only pdf files allowed in application form!');
            }
            $applicationFormPath = $uploadPath. strtolower($formNumber.'-signed.'.$applicationFormExt);
            if(move_uploaded_file($applicationForm['tmp_name'], $applicationFormPath)) {
                wh_log('API Controller Application form uploaded successfully :' .$applicationFormPath);
            }
        }
        echo save_application_form($mobile, $formNumber, $applicationFormPath);
        break;
    
    case 'check-application-status':
        $userKey = generateUserKeyForXP();
        echo $userKey;
        break;

    case 'xp-apis-call':
        $mobile = isset($_POST['mobile']) ? $_POST["mobile"] : '';
        $formNumber = isset($_POST['formNumber']) ? $_POST["formNumber"] : '';
        
        wh_log('API Controller with action: '.$action.', values are [mobile: '.$mobile.', formNumber: '.$formNumber.']');

        if(empty($mobile) || empty($formNumber)) 
            die('invalid mobile or formnumber...');

        $user = json_decode(fetchUserInformation($mobile));
        
        if($user->status == 'fail') 
            die('invalid user details...');

        $finalApplicationForm = combineApplicationFormWithPanAndGst($user->form_number, $user->application_form->application_form, $user->customer_card_details->pan_file, $user->customer_card_details->gst_file);
        wh_log('API Controller with action: '.$action.', finalApplicationForm ['.$finalApplicationForm.']');
        echo 'success';
        break;

    default:
        die('Invalid Action!');
}

?>