<?php
date_default_timezone_set("Asia/Calcutta");
error_reporting(E_ERROR | E_PARSE);

$timeSession = 30*60;
// server should keep session data for AT LEAST 30 Minutes
ini_set('session.gc_maxlifetime', $timeSession);
session_set_cookie_params($timeSession);
session_start();

$domain = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') ? 'https://' : 'http://';
$domain .= $_SERVER['HTTP_HOST']. '/';

define('WEB_URL', $domain . 'xtrapower-live/');
define('WEB_LOGIN_URL', 'https://login.iocxtrapower.com/Userlogin.aspx');
define('WEB_BLOGS_URL', 'http://xtrapower.pkonline.in/');

define('GOOGLE_MAP_KEY', 'AIzaSyB54TimSy7yrWzndaFtxXCj02ptycgjeEE');

define('AWS_SES_SENDER_MAIL', 'admin@utsav.yoga');
define('AWS_SES_SENDER_NAME', 'XTRAPOWER');
define('AWS_SES_SMTP_USERNAME', 'AKIA2VQZN6RAORV4PCWW');
define('AWS_SES_SMTP_PASSWORD', 'BED1zE5vy1oOFAh2w4/sL2SnnlgSVKzcaprpRGROVBX7');
define('AWS_SES_SMTP_HOST', 'email-smtp.us-east-1.amazonaws.com');
define('AWS_SES_SMTP_PORT', 587);

define('CONTACT_US_QUERY_MAIL', 'ramesh.k@pkonline.in');

define('CORPORATE_WEBSITE', 'https://iocl.com/');
define('SWAGAT_OUTLETS_URL', 'https://swagat.iocxtrapower.com/search.html?view=table');
define('SEARCH_RETAIL_OUTLETS', 'https://www.xtrarewards.com/networked-retail-outlets/?lat=28.6862738&lng=77.2217831&action=nearBy');
define('RETAIL_SELLING_PRICE', 'https://iocl.com/TotalProductList.aspx');

define('API_FORM_NUMBER_VALIDATION', '/ApplicationNoValidation');
define('SMS_GATEWAY_URL', '');

define('DATABSE_HOST', 'localhost');
define('DATABSE_USERNAME', 'root');
define('DATABSE_PASSWORD', 'rkj');
define('DATABSE_NAME', 'test');

define('APPLICATION_FORM_TEMPLATE', 'assets/XTRAPOWER_Application_Form.pdf');

define('XTRAPOWER_API_AGENT_INFO', 'PRE-LOGIN');
define('XTRAPOWER_API_USERNAME', 'kirti@xpdev');
define('XTRAPOWER_API_PASSWORD', 'kirti@123');

define('XTRAPOWER_API_BASE_URL', 'https://uat.iocxtrapower.com/FleetAPPApi');
define('XTRAPOWER_API_AUTHENTICATE_USER', '/Login/AuthenticateUser');
define('XTRAPOWER_API_GET_PENDING_CUSTOMERS', '/Customer/GetPendingCustomers');


function wh_log($log_msg) {
    $log_filename = "logs";
    if (!file_exists($log_filename)) {
        mkdir($log_filename, 0777, true);
    }
    $log_file_data = $log_filename.'/xtrapower.' . date('Y-m-d') . '.log';

    $final_msg = date('H:i:s.B') . ' ' . $_SERVER['REQUEST_URI'] . ' ' . $log_msg . "\n";
    file_put_contents($log_file_data, $final_msg, FILE_APPEND);
}


?>