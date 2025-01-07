<?php

$alert = "";
if(isset($_POST['submit'])){

    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $topic = $_POST['topic'];
    $email = $_POST['email'];
    $massage = $_POST['massage'];


    require("./venobox/phpmailer/class.phpmailer.php");
    $mail = new PHPMailer();

    $mail->IsSMTP();                                      // set mailer to use SMTP
    $mail->Host = "mail.trevelyanbd.com";  // specify main and backup server
    $mail->SMTPAuth = true;     // turn on SMTP authentication
    $mail->Username = "support@trevelyanbd.com";  // SMTP username
    $mail->Password = "us33f3d@DAU+"; // SMTP password
    $mail->Port = '587';
    $mail->SMTPSecure = 'tls';

    $mail->From = $email;
    $mail->FromName = $name;
    $mail->AddAddress("support@trevelyanbd.com");
    //$mail->AddAddress("sisagor767@gmail.com");
    //$mail->AddAddress("ellen@example.com");                  // name is optional
    $mail->AddReplyTo("support@trevelyanbd.com");

    $mail->WordWrap = 50;                                 // set word wrap to 50 characters
    $mail->AddAttachment("/var/tmp/file.tar.gz");         // add attachments
    $mail->AddAttachment("/tmp/image.jpg", "new.jpg");    // optional name
    $mail->IsHTML(true);                                  // set email format to HTML

    $mail->Subject = "Contact Request from ".$name." for ". $topic;
    $mail->Body = "
                <strong>Name: $name </strong></br>
                <strong>Phone: $phone </strong></br>
                <strong>Topic: $topic </strong></br>
                <p> $massage </p>
            ";
    // $mail->AltBody = "This is the body in plain text for non-HTML mail clients";


    //Test plain mail;


    $to = "support@trevelyanbd.com";
    $subject ="Contact Request from ".$name." for ". $topic;
    $txt = " Name: $name " ."\n". "
             Phone: $phone " ."\n". "
             Topic: $topic " ."\n". "
             Massage:  $massage
            ";

    $headers = "From: $email" . "\r\n" . "CC: somebodyelse@example.com";

    try {

        ///Here will send mail function

        $send = mail($to,$subject,$txt,$headers);
        //$mail->Send();
        //var_dump("email send");
    }catch (Exception $exception)
    {
        //Error will catch here
        var_dump($exception);
        exit();
    }

    $alert =  "Email has been sent";
}
