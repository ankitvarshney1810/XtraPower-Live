<?php

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// If necessary, modify the path in the require statement below to refer to the
// location of your Composer autoload.php file.
require 'assets/composer/vendor/autoload.php';
require 'config.php';

function sendMail($recipient, $subject, $bodyHtml) {
    $mail = new PHPMailer(true);

    try {
        // Specify the SMTP settings.
        $mail->isSMTP();
        $mail->setFrom(AWS_SES_SENDER_MAIL, AWS_SES_SENDER_NAME);
        $mail->Username   = AWS_SES_SMTP_USERNAME;
        $mail->Password   = AWS_SES_SMTP_PASSWORD;
        $mail->Host       = AWS_SES_SMTP_HOST;
        $mail->Port       = AWS_SES_SMTP_PORT;
        $mail->SMTPAuth   = true;
        $mail->SMTPSecure = 'tls';
        // $mail->addCustomHeader('X-SES-CONFIGURATION-SET', $configurationSet);
    
        // Specify the message recipients.
        $mail->addAddress($recipient);
        // You can also add CC, BCC, and additional To recipients here.
    
        // Specify the content of the message.
        $mail->isHTML(true);
        $mail->Subject    = $subject;
        $mail->Body       = $bodyHtml;
        // $mail->AltBody    = $bodyText;
        $mail->Send();
        return "Thank you contacting us. We will reach you shortly!";
    } catch (phpmailerException $e) {
        return "An error occurred. ". $e->errorMessage(); //Catch errors from PHPMailer.
    } catch (Exception $e) {
        return "Email not sent. ". $mail->ErrorInfo; //Catch errors from Amazon SES.
    }
}
?>