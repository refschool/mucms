<?php
//see cligs.php
include(config.php); include(class.php);

$message = $_GET['message'];

if(isset($message)){
	if(strlen($message)<1){
	$error1=1;
	} else {
	$twitter_status=tweet($username, $psw, $message);
	}
}