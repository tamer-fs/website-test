<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
// error_reporting(-1);
// ini_set('display_errors', 'On');
// set_error_handler("var_dump");
// ini_set("mail.log", "/tmp/mail.log");
// ini_set("mail.add_x_header", TRUE);

// $to = "tf.sparreboom@gmail.com";
// $subject = "Thank you for your purchase";

// $headers = array(
//     "MIME-version" => "1.0",
//     "Content-Type" => "text/html;charset=UTF-8",
//     "From" => "vliegendekip6@gmail.com",
//     "Reply-To" => "vliegendekip6@gmail.com"
// );

// $message = "<h1>Hello mensen</h1>";

// if ($send = mail($to, $subject, $message, $headers)) {
//     echo "gelukt";
// };

$mail = new PHPMailer(true);
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = "vliegendekip6@gmail.com";
$mail->Password = "livnfmmxfsiddvnw";
$mail->SMTPSecure = "ssl";
$mail->Port = 2525;

$mail->setFrom("vliegendekip6@gmail.com");
$mail->addReplyTo("vliegendekip6@gmail.com");

$mail->addAddress("tf.sparreboom@gmail.com");

$mail->isHTML(true);

$mail->Subject = "<h1>test</h1>";

$bodyContent = "<h1> Hello </h1>";
$mail->Body = $bodyContent;
if (!$mail->send()) {
    echo ":(";
} else {
    echo "chad";
}
