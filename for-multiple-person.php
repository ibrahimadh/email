<?php

// phpmailer-simplemh-multi-recipient-example.php
// Inject multiple test messages into GreenArrow Engine using PHPMailer and SimpleMH

// Use PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//locate the autoload for phpmailer
require 'vendor/autoload.php';

//define host
$host = 'email-smtp.ap-southeast-1.amazonaws.com';
//define port
$port = 587;
//define username for smtp
$usernameSmtp = 'AKIAUNLUBEAMIMPDZ55X';
//define password for smtp
$passwordSmtp = 'BBKGYdHaoER5XfNJALUfEGHf8owgnbEgg9vnHnGqWMID';


//define the sender
$from_address = "no-reply@joven.my.id";
$from_name = "mustard";

//define subject and content for the email
$subject = "test-mail for ASW SES multiple address";
$html_body = "Hello this is a test mail, thanks in advance.";
$text_body = "Hello this is a test mail, thanks in advance.";


//$mail_class = "transactional"; // Mail Class to use

// List of recipients
$recipients = array(
	"ibrahimadham84@gmail.com" => "baim",
	"jvavvscloud@jovenindo.com" => "jove",
	"hoodiedongker@gmail.com" => "hudi"
);

// Create the SMTP session
$mail = new PHPMailer();
$mail->IsSMTP(); // Use SMTP
$mail->Username   = $usernameSmtp;
$mail->Password   = $passwordSmtp;
$mail->Host       = $host;
$mail->Port       = $port;
$mail->SMTPAuth   = true;
$mail->SMTPSecure = 'tls';

// Set headers that are constant for every message outside of the foreach loop
$mail->SetFrom($from_address, $from_name);
$mail->Subject = $subject;
//$mail->addCustomHeader("X-GreenArrow-MailClass: $mail_class");

// Send a message to each recipient.
// Headers that are unique for each message should be set within the foreach loop
foreach ($recipients as $email => $name) {

	// Generate headers that are unique for each message
	$mail->ClearAllRecipients();
	$mail->AddAddress($email, $name);

	// Generate the message
	$mail->MsgHTML($html_body);
	$mail->AltBody = $text_body;
	//for adding attachment, select the path, then the file.
	//dont forget the file type
	$mail->addAttachment("vendor/WMTI-2023-NH05075.pdf",'WMTI-2023-NH05075.pdf');

	// Send the message 
	if($mail->Send()) {
		echo "Message sent!\n";
	} else {
		echo "Mailer Error: " . $mail->ErrorInfo . "\n";
	}

}

// Close the SMTP session
$mail->SmtpClose();