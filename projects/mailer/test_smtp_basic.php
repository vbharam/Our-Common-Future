<html>
<head>
<title>PHPMailer - SMTP basic test with authentication</title>
</head>
<body>

<?php

//error_reporting(E_ALL);
error_reporting(E_STRICT);

date_default_timezone_set('Asia/Kolkata');

require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

$mail             = new PHPMailer();

$body             =  "
Dear Customer<br><br>

Thank you for signing up with DayHalt.com. <span style='font-size:11px'>We are glad you joined us</span>.<br><br>
<div style='font-size:11px;'>
 As a part of our promotional offer for our initially few customers, like
our facebook page (www.facebook.com/DayHalt) & avail 10% discount on any
booking (only once) within 30 days of our launch <b>(we are getting live on
11th Aug 2013)</b>.<br><br>
 At DayHalt.com, you can book luxury & boutique hotel rooms for a few hours
during the day time at deeply discounted rates. How deeply? Up to 50-60%
off. In other words, we give you access to hotels which otherwise not
possible to book at a given cost.<br><br>
 A Unique Product in Hotel Industry. <br>
 We have listing of rooms from
luxurious 5 star to Boutique hotels & apartments across the country
depending on our customers need and budget. Each room is rented during day
hours and once a day only.<br>
 Ideal for<br>
 1. Corporate traveler to relax & refresh up before and after meeting hours. <br>
 2. Airport Transit Passengers <br>
 3. To Keep your luggage. 
 4. To take a nap during road journey. <br>
 5. Business people to hold meeting at Luxurious suites <br>
6. People visiting at religious places <br>
7. Ladies for Kitty Parties. <br>
8. People attending fairs and conferences<br> 
& many such instances where you can use hotels during daytime.<br>
Before Dayhalt, finding hotel rooms for the day was, if not impossible,
very complicated. Availabilities were uncertain, quality was dubious, and
sometimes, you even had to endure nasty looks or comments from hotel staff.
Transactions often could only be made at the hotel, in cash. Dayhalt
delivers convenience, transparency and ease of use.<br>
Book online, show up at the hotel, proceed to a quick check in, take your keys and possession of
your room...and check out a few hours later. It's that simple.<br><br>
If you have any requirement as of now, don't hesitate to call us at
9920488189 or send email - info@dayhalt.com, dayhalt@gmail.com<br><br><br>
 
 </div>
 <b>
Thanks,<br>
DayHalt Team<br><br>
www.dayhalt.com<br><br>
www.fb.com/dayhalt</b>
";


$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "relay-hosting.secureserver.net"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->Host       = "relay-hosting.secureserver.net"; // sets the SMTP server                  // set the SMTP port for the GMAIL server
$mail->Username   = "info@happyshoppie.in"; // SMTP account username
    // SMTP account password

$mail->SetFrom('info@happyshoppie.in', 'DayHalt');

$mail->AddReplyTo("info@happyshoppie.in","DayHalt");

$mail->Subject    = 'Welcome to Dayhalt.com | Indias #1st online portal to book hotels for "DayUse"';

$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

$mail->MsgHTML($body);

$address = "prabakaranbs@gmail.com";
$mail->AddAddress($address, "Prabakaran");

 // attachment

if(!$mail->Send()) {
  echo "Mailer Error: " . $mail->ErrorInfo;
} else {
  echo "Message sent!";
}

?>

</body>
</html>
