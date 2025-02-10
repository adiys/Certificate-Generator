<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function mailer($email, $name, $file_name)
{
//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'otp.stm@gmail.com';                     //SMTP username
    $mail->Password   = 'SECRET';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('reach@stmorg.in', 'STM');
    $mail->addAddress($email, $name);     //Add a recipient
    $mail->addAddress($email);               //Name is optional
    $mail->addReplyTo('reach@stmorg.in', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    $mail->addAttachment($file_name);         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    // message
    $message = '<div
    style="
      font-family: Helvetica, Arial, sans-serif;
      min-width: 1000px;
      overflow: auto;
      line-height: 2;
    "
  >
    <div style="margin: 50px auto; width: 70%; padding: 20px 0">
      <div style="border-bottom: 1px solid #eee">
        <a
          href=""
          style="
            font-size: 1.4em;
            color: #00466a;
            text-decoration: none;
            font-weight: 600;
          "
          >Service To Mankind</a
        >
      </div>
      <p style="font-size: 1.1em">Hi '.$name.',</p>
      <p style="font-size: 1.1em">
        We would like to thank you for attending the WEB 3.0 Workshop conducted by
        Service To Mankind. We hope that the workshop has provided you with
        valuable insights into the world of cryptocurrency, blockchain, and
        decentralized applications.<br />
        As promised, we are sending you the certificates for your participation in
        the workshop. You can find the attached certificates in this email. Please
        make sure to download and save your certificate for future reference.<br />
        We would also like to take this opportunity to request your feedback on
        the workshop. We value your input and would appreciate it if you could
        take a few minutes to fill out the Google Form feedback survey. Your
        feedback will help us improve our future events and provide better
        experiences to our participants.<br />
        link: <a href="">link</a> <br />
        Once again, we thank you for making the workshop a success. We hope that
        the knowledge gained through this workshop will help you in your future
        endeavors.
      </p>
      <p style="font-size: 1.1em">Regards,<br />Service To Mankind</p>
    </div>
    <div
      style="
        font-size: 0.9em;
        margin: 30px auto;
        padding-top: 20px;
        width: 70%;
        border-top: 1px solid #eee;
      "
    >
      <div style="text-align: center; margin-top: 1em">
        sponsered by
        <a
          href="https://weber.cottonseeds.org"
          style="
            color: #000;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.2em;
          "
          >Weber Technologies</a
        >
      </div>
    </div>
  </div>
  
  
  ';
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Web 3.0 Certificate Of Completion';
    $mail->Body    = $message;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
}