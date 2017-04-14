<?php
require_once('class.phpmailer.php');
error_log('Received', 3, "gmaillog.log");

// CONFIG YOUR FIELDS
//============================================================
$name =     filter_var($_POST["name"], FILTER_SANITIZE_STRING);
$last_name =     filter_var($_POST["last_name"], FILTER_SANITIZE_STRING);
$email =    filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
$formMessage =  filter_var($_POST["message"], FILTER_SANITIZE_STRING);
$link = 'http://techiwala.com';
$to = 'example@techiwala.com';
$to_name = 'Admin Techiwala';
// CONFIG YOUR EMAIL MESSAGE
//============================================================
$message = '<p>The following request was sent from: </p>';
$message .= '<p>First Name: ' . $name . '</p>';
$message .= '<p>Last Name: ' .  $last_name .'</p>';
$message .= '<p>Email: ' . $email . '</p>';
$message .= '<p>Message: ' . $formMessage .'</p>';
$message .= '<p>Thank You: ' . $link .'</p>';

//Logging Report to Test
error_log($message, 3, "gmaillog.log");
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  $mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "yourusername@gmail.com";  // GMAIL username
  $mail->Password   = "yourpassword";            // GMAIL password
  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->AddAddress('whoto@otherdomain.com', 'John Doe');
  $mail->SetFrom('name@yourdomain.com', 'First Last');
  $mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->Subject = 'PHPMailer Test Subject via mail(), advanced';
  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
  $mail->MsgHTML($message);
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  $msg = "Message Sent OK</p>\n";
  echo $msg;
  error_log($msg, 1, "gmaillog.log");
} catch (phpmailerException $e) {
  echo $e->errorMessage(); //Pretty error messages from PHPMailer
  error_log($e->errorMessage(), 3, "gmaillog.log");
} catch (Exception $e) {
  echo $e->getMessage(); //Boring error messages from anything else!
}
?>

</body>
</html>
