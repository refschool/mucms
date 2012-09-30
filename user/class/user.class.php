<?php
/*This class is used to manage users*/

class User {

function account_not_active($username){
	global $db;global $tprefix;
	$sql = "select `act_stat` from `".$tprefix."_users` where `username` = '$username'";
	$result = $db->query($sql);
	if($row = $result->fetch_assoc()){
		$act_stat = $row['act_stat'];
	}
	else {
		return FALSE;
	}
	
	if($act_stat == 'I'){
	return TRUE;
	}
	else {
		return FALSE;
	}
	
}


function generatePassword ($length = 8)
{
//thanks to http://www.laughing-buddha.net/jon/php/password/
  // start with a blank password
  $password = "";

  // define possible characters
  $possible = "0123456789bcdfghjkmnpqrstvwxyz"; 
    
  // set up a counter
  $i = 0; 
    
  // add random characters to $password until $length is reached
  while ($i < $length) { 

    // pick a random character from the possible ones
    $char = substr($possible, mt_rand(0, strlen($possible)-1), 1);
        
    // we don't want this character if it's already in the password
    if (!strstr($password, $char)) { 
      $password .= $char;
      $i++;
    }

  }

  // done!
  return $password;
}

/* show the recently created accounts*/
function showLatestMembers ($db,$howMany){
$mydb = $db;
$latestMembersInfo = array();
$user = array();
$datejoin = array();
$n = $howMany;

//building of the sql query
$latestMembers = "SELECT `username`,`crea_dat` FROM `aae_users` WHERE `act_stat` = 'A' ORDER BY `crea_dat` DESC LIMIT ".$n ;

//echo $latestMembers;
//putting result in arrays

$result = $mydb->query($latestMembers);
//print_r($result);

	while($row = $result->fetch_assoc()){
	
	$user[] = $row["username"];
	$datejoin[] = substr($row["crea_dat"],0,10);
	
	}
	
	//print_r($user);

	for($i=0;$i<count($user);$i++){
		$latestMembersInfo[$i] = '<li><a href="http://annuaire-auto-entrepreneurs.org/public/'.$user[$i].'">'.$user[$i].'</a><br /> nous a rejoint le :'.$datejoin[$i].'<li>';
	}
	//print_r($latestMembersInfo);
	
	$lastmembers =  '<ul>';
	
	for($j=0;$j<count($user);$j++){
	
		$lastmembers .= $latestMembersInfo[$j] ;
	
	}
	
	$lastmembers .= '</ul>';
	return $lastmembers;
}
/*
 * this function logs the activity of the users
 *
 *
 */
function _LOG($db, $log_msg, $user_id,$username){
	global $tprefix;

	$ip = $_SERVER['REMOTE_ADDR'];
	$timestamp = date("Y-m-d H:i:s");

	switch($log_msg){
	case "login_ok":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";
	//echo $sql;
	break;
	
	case "login_fail":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";
	//echo $sql;
	break;	
	
	case "passwreq":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";	
	break;
	
	case "passupdt":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";	
	break;
	
	case "captchafail":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";		
	break;	
	
	case "add_image":
	$sql = "insert into `$tprefix"."_logs`(`IP`, `log_msg`, `user_id`, `username`, `timestamp`)  values ('$ip','$log_msg','$user_id','$username','$timestamp');";		
	break;	
	}

	$db->query($sql) or die('Error');
		
}


}


?>