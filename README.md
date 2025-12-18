# PHP SMTP Lib

> Original Repos:   
> - PHP SSH Lib: https://github.com/a19836/php-smtp-lib/   
> - Bloxtor: https://github.com/a19836/bloxtor/

## Overview

**PHP SMTP Lib** is a PHP library that allows you to send emails reliably through SMTP servers using a simple and configurable API.  
It provides full control over SMTP connections and message composition, making it suitable for transactional emails, notifications, and automated messaging.

The library supports **authenticated SMTP connections**, secure transport protocols, and common email features such as HTML content, plain text fallback, attachments, and custom headers.

With this library, you can:
- Send emails through any SMTP server
- Authenticate using username and password
- Use secure connections (SSL / TLS)
- Compose HTML and plain text emails
- Add attachments and inline resources
- Set custom headers, CC, BCC, and reply-to addresses
- Handle connection errors and delivery feedback

This library is ideal for applications that require full control over email delivery without relying on external APIs or third-party services.

To see a working example, open [index.php](index.php) on your server.

---

## Usage

### Simple Usage

```php
include __DIR__ . "/lib/SmtpEmail.php";

$SmtpEmail = new SmtpEmail($smtp_host, $smtp_port, $smtp_user, $smtp_pass, "ssl");
$status = $SmtpEmail->send($from_email, $from_name, $reply_to_email, $reply_to_name, $to_email, $to_name, $subject, $message);

echo $status ? "OK" : $SmtpEmail->getErrorInfo();
```

### Complete Usage

```php
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
```

