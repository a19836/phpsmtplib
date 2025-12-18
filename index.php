<?php
/*
 * Copyright (c) 2025 Bloxtor (http://bloxtor.com) and Joao Pinto (http://jplpinto.com)
 * 
 * Multi-licensed: BSD 3-Clause | Apache 2.0 | GNU LGPL v3 | HLNC License (http://bloxtor.com/LICENSE_HLNC.md)
 * Choose one license that best fits your needs.
 *
 * Original PHP SMTP Lib Repo: https://github.com/a19836/php-smtp-lib/
 * Original Bloxtor Repo: https://github.com/a19836/bloxtor
 *
 * YOU ARE NOT AUTHORIZED TO MODIFY OR REMOVE ANY PART OF THIS NOTICE!
 */
?>
<style>
h1 {margin-bottom:0; text-align:center;}
h5 {font-size:1em; margin:40px 0 10px; font-weight:bold;}
p {margin:0 0 20px; text-align:center;}

.note {text-align:center;}
.note span {text-align:center; margin:0 20px 20px; padding:10px; color:#aaa; border:1px solid #ccc; background:#eee; display:inline-block; border-radius:3px;}
.note li {margin-bottom:5px;}

.code {display:block; margin:10px 0; padding:0; background:#eee; border:1px solid #ccc; border-radius:3px; position:relative;}
.code:before {content:"php"; position:absolute; top:5px; left:5px; display:block; font-size:80%; opacity:.5;}
.code textarea {width:100%; height:300px; padding:30px 10px 10px; display:inline-block; background:transparent; border:0; resize:vertical; font-family:monospace;}
.code.short textarea {height:160px;}
</style>
<h1>PHP SMTP Lib</h1>
<p>Sends emails through SMTP</p>
<div class="note">
		<span>
		This library allows you to send emails reliably through SMTP servers using a simple and configurable API.<br/>
		It provides full control over SMTP connections and message composition, making it suitable for transactional emails, notifications, and automated messaging.<br/>
		<br/>
		The library supports <b>authenticated SMTP connections</b>, secure transport protocols, and common email features such as HTML content, plain text fallback, attachments, and custom headers.<br/>
		<br/>
		With this library, you can:<br/>
		<ul style="display:inline-block; text-align:left;">
			<li>Send emails through any SMTP server</li>
			<li>Authenticate using username and password</li>
			<li>Use secure connections (SSL / TLS)</li>
			<li>Compose HTML and plain text emails</li>
			<li>Add attachments and inline resources</li>
			<li>Set custom headers, CC, BCC, and reply-to addresses</li>
			<li>Handle connection errors and delivery feedback</li>
		</ul>
		<br/>
		This library is ideal for applications that require full control over email delivery without relying on external APIs or third-party services.
		</span>
</div>

<div>
	<h5>Simple Usage</h5>
	<div class="code short">
		<textarea readonly>
include __DIR__ . "/lib/SmtpEmail.php";

$SmtpEmail = new SmtpEmail($smtp_host, $smtp_port, $smtp_user, $smtp_pass, "ssl");
$status = $SmtpEmail->send($from_email, $from_name, $reply_to_email, $reply_to_name, $to_email, $to_name, $subject, $message);

echo $status ? "OK" : $SmtpEmail->getErrorInfo();
		</textarea>
	</div>
</div>

<div>
	<h5>Complete Usage</h5>
	<div class="code">
		<textarea readonly>
include __DIR__ . "/lib/SmtpEmail.php";

$validated_to_email = SmtpEmail::getEmail($to_email);

if (!$validated_to_email)
	echo "Invalid email format";
else {
	$smtp_secure = "ssl";//ssl, tls or null
	$SmtpEmail = new SmtpEmail($smtp_host, $smtp_port, $smtp_user, $smtp_pass, $smtp_secure, $smtp_encoding = 'utf-8');
	
	//Enable SMTP debugging
	//$debug:
	// 0 = off (for production use)
	// 1 = client messages
	// 2 = client and server messages
	$SmtpEmail->setDebug($debug, $output = 'echo');
	
	//prepare message
	$subject = "This is a test email with html and attachments";
	$message = '<h1>Test email</h1><p>Some info about the email:</p><ul><li>Info A</li><li>Info B</li><li>Info C</li></ul>';
	
	//prepare attachments
	$attachments = array();
	$attachments[] = array(
		"path" => $uploaded_file_1_path,
		"name" => $uploaded_file_1_name,
	);
	$attachments[] = array(
		"path" => $uploaded_file_2_path,
		"name" => $uploaded_file_2_name,
	);
	
	//send email
	$status = $validated_to_email && $SmtpEmail->send($from_email, $from_name, $reply_to_email, $reply_to_name, $validated_to_email, $to_name, $subject, $message, $attachments);

	echo $status ? "OK" : $SmtpEmail->getErrorInfo();
}
		</textarea>
	</div>
</div>

