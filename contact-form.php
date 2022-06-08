<?php

require 'amazon-ses-smtp-sample.php';

$name = isset($_POST['name']) ? $_POST["name"] : '';
$email = isset($_POST['email']) ? $_POST["email"] : '';
$msgSubject = isset($_POST['msg_subject']) ? $_POST["msg_subject"] : '';
$message = isset($_POST['message']) ? $_POST["message"] : '';

if(empty($name)) {
    die('name field is manadatory!');
} else if(empty($email)) {
    die('email field is manadatory!');
} else if(empty($msgSubject)) {
    die('subject field is manadatory!');
} else if(empty($message)) {
    die('message field is manadatory!');
}

$subject = 'Contact Us Query | ' . $name;
$bodyHtml = 'Contact Us Query From <b>' . $name . '</b><br/>Email Id: <b>' . $email . '</b><br/>Subject: <b>' . $msgSubject . '</b><br/>Message: <b>' . $message . '</b>';

echo sendMail(CONTACT_US_QUERY_MAIL, $subject, $bodyHtml);
die();
?>