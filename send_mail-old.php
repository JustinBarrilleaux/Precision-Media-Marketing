<?php
global $_POST;
$mail_to = 'Barrilleauxjustin@gmail.com'; //Your email here

// Required fields
$email = isset( $_POST['email'] ) ? strip_tags( trim( $_POST['email'] ) ) : '';
$name  = isset( $_POST['name'] ) ? strip_tags( trim( $_POST['name'] ) ) : '';
$text  = isset( $_POST['message'] ) ? strip_tags( trim( $_POST['message'] ) ) : '';
// Additional fields
$subject   = isset( $_POST['subject'] ) ? strip_tags( trim( $_POST['subject'] ) ) : '';
$permalink = isset( $_POST['permalink'] ) ? strip_tags( trim( $_POST['permalink'] ) ) : '';
$phone     = isset( $_POST['phone'] ) ? strip_tags( trim( $_POST['phone'] ) ) : '';
$company   = isset( $_POST['company'] ) ? strip_tags( trim( $_POST['company'] ) ) : '';

$mail_subject = $subject != '' ? $subject : 'From Contact form on website';

$message = '<h3>You got an email from your website:</h3>' . '<br/>';

if ( ! empty( $name ) ) {
	$message .= '<b>Name:</b> ' . $name . '<br/>';
}
if ( ! empty( $permalink ) ) {
	$message .= '<b>Email:</b> ' . $email . '<br/>';
}
if ( ! empty( $permalink ) ) {
	$message .= '<b>Website:</b> ' . $permalink . '<br/>';
}
if ( ! empty( $phone ) ) {
	$message .= '<b>Phone:</b> ' . $phone . '<br/>';
}
if ( ! empty( $company ) ) {
	$message .= '<b>Company:</b> ' . $company . '<br/>';
}

$message .= '<b>Message:</b> ' . $text . '<br/>';
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers

$from = "info@precisionmediamarketing.com";

$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();

if(isset($_POST["redirect"])){
	$message .= "<b> Section </b>: ".$_POST["redirect"]."<br/>";
}
else{
	$message .= "<b> Section </b>: Contact Form<br/>";
}

$mail = mail( $mail_to, $mail_subject, $message, $headers );


if($mail){

		$sub = "Confirmation message";

		$msg = "Thanks for contacting PMM, we will be contacting you shortly.";

		// if(isset($_POST["redirect"])){
			mail($email, $sub, $msg, $headers);
		// }

}


if(isset($_POST["redirect"])){
	if($mail){

			header("Location: ".$_POST["redirect"]);

	}
}