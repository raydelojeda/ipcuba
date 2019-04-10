<?php 

require("PHPMailerv2/class.phpmailer.php");

class MyMailer extends PHPMailer {
    // Set default variables for all new objects
    var $From     = "usuario@one.cu";
    var $FromName = "ONE";
	
	
	//------------------------------------------------------------------------------------------------
$gestion = @fopen("c:\ip.txt", "r");
if ($gestion) 
{
	while (!feof($gestion)) 
	{
		$ip = $ip.fgets($gestion);	
																
	}
	fclose ($gestion);
}

//-------------------------------------------------------------------------------------------------
	
	
    var $Host     = $ip;
    var $Mailer   = "smtp";                         // Alternative to IsSMTP()
    var $WordWrap = 75;
	var $SMTPAuth = true;
	var $Username = "usuario";
	var $Password ="";

    // Replace the default error_handler
    function error_handler($msg) {
        print("My Site Error");
        print("Description:");
        printf("%s", $msg);
        exit;
    }

    // Create an additional function
    function do_something($something) {
        // Place your new code here
    }
}

?>