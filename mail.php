	<?php

		require_once('class.phpmailer.php');
			error_log('Received', 3, "maillog.log");

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
			error_log($message, 3, "maillog.log");


			$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

			$mail->IsSMTP(); // telling the class to use SMTP

			try {
		  $mail->Host       = "mail.ellipsonic.com"; // SMTP server
		  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
		  $mail->SMTPAuth   = true;                  // enable SMTP authentication
		  $mail->Host       = "mail.ellipsonic.com"; // sets the SMTP server
		  $mail->Port       = 26;                    // set the SMTP port for the GMAIL server
		  $mail->Username   = "example@techiwala.com"; // SMTP account username
		  $mail->Password   = "testpassword";        // SMTP account password
		  $mail->AddReplyTo('example@techiwala.com', 'example@techiwala.com');
		  //$mail->AddAddress($to, $to_name); // To address on form submit
			$mail->AddAddress($email, $name); // To address on form submit
		  $mail->SetFrom('example@techiwala.com', 'example@techiwala.com'); // From Address
		  $mail->AddReplyTo('example@techiwala.com', 'example@techiwala.com'); // Reply To address
		  $mail->Subject = '::Contact Form Submission::'; // Mail Subject
		  $mail->AltBody = 'To view the message, please use an HTML compatible email viewer!'; // optional - MsgHTML will create an alternate automatically
		  $mail->MsgHTML($message); // Mail Body
		  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
		  //$mail->AddAttachment('images/logo.png'); // attachment
		  $mail->Send();
			$msg = "Message Sent OK</p>\n";
			echo $msg;
			error_log($msg, 1, "maillog.log");

		}
		catch (phpmailerException $e) {
		  echo $e->errorMessage(); //Pretty error messages from PHPMailer
		  error_log($e->errorMessage(), 3, "maillog.log");

		} catch (Exception $e) {
		  echo $e->getMessage(); //Boring error messages from anything else!
		}
		?>
