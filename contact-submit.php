<?php
require 'vendor/autoload.php';

if($_POST) {
    $to_Email   	= "jiyena9354@inwmail.net"; //Replace with recipient email address
    $subject        = 'Web Enquiry'; //Subject line for emails

    //check if its an ajax request, exit if not
    if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {

        //exit script outputting json data
        $output = json_encode(
        array(
            'type'=>'error',
            'text' => 'Request must come from Ajax'
        ));

        die($output);
    }

    //check $_POST vars are set, exit if any missing
    if(!isset($_POST["userName"]) || !isset($_POST["userEmail"]) || !isset($_POST["emailNumber"]) ||
        !isset($_POST["legal_problem"])|| !isset($_POST["userTime"])|| !isset($_POST["userHours"]))
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Input fields are empty!'));
        die($output);
    }

    //Sanitize input data using PHP filter_var().
    $user_Name        = filter_var($_POST["userName"], FILTER_SANITIZE_STRING);
    $user_Email       = filter_var($_POST["userEmail"], FILTER_SANITIZE_EMAIL);
    $email_Number      = filter_var($_POST["emailNumber"], FILTER_SANITIZE_EMAIL);
    $legal_problem     = filter_var($_POST["legal_problem"], FILTER_SANITIZE_STRING);
    $user_Time     = filter_var($_POST["userTime"], FILTER_SANITIZE_STRING);
    $user_Hours     = filter_var($_POST["userHours"], FILTER_SANITIZE_STRING);

    //additional php validation
    if(strlen($user_Name)<3) // If length is less than 3 it will throw an HTTP error.
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Name is too short or empty!'));
        die($output);
    }
	if(strlen($email_Number)<10) // If length is less than 4 it will throw an HTTP error.
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid phone number!'));
        die($output);
    }
    if(!filter_var($user_Email, FILTER_VALIDATE_EMAIL)) //email validation
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Please enter a valid email!'));
        die($output);
    }

    if(strlen($legal_problem)<3) //check  message
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Too short legal problem! Please enter something.'));
        die($output);
    }
    if(strlen($user_Time) < 1) //check  time
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Please select when date are you coming'));
        die($output);
    }
    if(strlen($user_Hours) < 1) //check  hours
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Please select when time are you coming'));
        die($output);
    }


    $message_Body = "<strong>Name: </strong>". $user_Name ."<br>";
	$message_Body .= "<strong>EmailNumber: </strong>". $email_Number ."<br>";
    $message_Body .= "<strong>Email: </strong>". $user_Email ."<br>";
    $message_Body .= "<strong>legal_problem: </strong>". $legal_problem ."<br>";
    $message_Body .= "<strong>:time </strong>". $user_Time ."<br>";
    $message_Body .= "<strong>hours: </strong>". $user_Hours ."<br>";



    $headers = "From: " . strip_tags($user_Email) . "\r\n";
    $headers .= "Reply-To: ". strip_tags($user_Email) . "\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";



    //proceed with PHP email.
    /*$headers = 'From: '.$user_Email.'' . "\r\n" .
    'Reply-To: '.$user_Email.'' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();
    */


    $sentMail = @mail($to_Email, $subject, $message_Body, $headers);

    if(!$sentMail)
    {
        $output = json_encode(array('type'=>'error', 'text' => 'Could not send mail! Please check your PHP mail configuration.'));
        die($output);
    }else{
        $output = json_encode(array('type'=>'message', 'text' => 'Hi '.$user_Name .' Thank you for contacting us.'));
        die($output);
    }
}
?>