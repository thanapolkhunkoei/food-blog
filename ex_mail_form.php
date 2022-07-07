<?php
 require('system/common.php');

/*
 *
Hostname : mail.promcondo.com
Username : phpmailer@promcondo.com
Password : WPpEi1AhNEW

WCMSetting::$SMTP_SERVER_HOSTNAME = "mail.dev-orisma.com";
WCMSetting::$SMTP_SERVER_USERNAME = "phpmailer@dev-orisma.com";
WCMSetting::$SMTP_SERVER_PASSWORD = "0rism@***";
WCMSetting::$SMTP_SERVER_PORT ="587";
 */
//===================== Mail ==============
	$mail = new OMCore\OMMail();

	$to_email = "apichart@orisma.com";
	$to_name = "Jedsadang";

	$mail->Sender = "info@orisma.com";
	$mail->From = "jed@orisma.com";
	$mail->FromName = "jed";
	$mail->AddAddress($to_email ,$to_name);

	$mail->Subject = "test mail";
	$mail->Body = "test mail";
	$mail->AltBody = "test mail";
	// $mail->SMTPDebug  = 2;




	if(!$mail->sendMail()){
		echo "result=error&msg=" . $mail->ErrorInfo;
		exit();
	}

	$mail->SmtpClose();
?>