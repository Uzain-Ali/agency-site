<?php
include("../config.php");
require '../vendor/autoload.php'; // if you install PHPMailer via Composer

use PHPMailer\PHPMailer\PHPMailer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name  = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $msg   = $conn->real_escape_string($_POST['message']);

    // save to DB
    $conn->query("INSERT INTO contacts(name, email, message) VALUES('$name','$email','$msg')");

    // send email
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com'; // For Gmail
        $mail->SMTPAuth = true;
        $mail->Username = 'muzainalisiddiqui@gmail.com'; // Your email
        $mail->Password = 'umfg nnip rnxm fhgb'; // Gmail app password
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender & recipient
        $mail->setFrom('muzainalisiddiqui@gmail.com', 'Agency Website');
        $mail->addAddress('muzainalisiddiqui@gmail.com'); // Where you want to receive messages

        $mail->isHTML(true);
        $mail->Subject = "New Contact Form Submission";
        $mail->Body    = "<b>Name:</b> $name<br><b>Email:</b> $email<br><b>Message:</b><br>$msg";

        $mail->send();
    } catch (Exception $e) {}

    header("Location: ../public/contact.php?success=1");
}
?>