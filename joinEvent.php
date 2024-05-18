<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // Server settings
        $mail->SMTPDebug = 0; 
        $mail->isSMTP(); 
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true; 
        $mail->Username = ''; 
        $mail->Password = ''; 
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587; 

        // Recipients
        $mail->setFrom('no-reply@yourwebsite.com', 'Your Website');
        $mail->addAddress($email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = 'Event Registration Confirmation';
        $mail->Body    = "
        <html>
        <head>
          <title>Event Registration Confirmation</title>
        </head>
        <body>
          <p>Dear $username,</p>
          <p>Thank you for joining our event!</p>
          <p>We are excited to have you with us.</p>
        </body>
        </html>
        ";
        $mail->AltBody = "Dear $username,\n\nThank you for joining our event!\nWe are excited to have you with us.";

        $mail->send();
        echo "A confirmation email has been sent to $email.";
        
        // Display a success message
        echo "<p>You have successfully joined the event, $username.</p><br><br>";
        echo "<a class='btnStyle' href='user.php' style='margin-top:30px;'>back</a>";
        echo "";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/adminArea.css" />

    <title>Document</title>
</head>
<body>
    
</body>
</html>