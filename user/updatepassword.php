<?php session_start();
 include ("../inc/config.php");include("class/user.class.php");

 //create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
	
	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>MAJ password</title>
<meta name="robots" content="noindex,nofollow" />
<meta name="description" content="Information 3" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>

<?php

 //code executed if the user is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username'])){
	 

$newpassword1 = strtolower(trim($_POST['newpassword1']));
$newpassword2 = strtolower(trim($_POST['newpassword2']));

	//the two fields are filled
	if(isset($newpassword1) && isset($newpassword2)){
	
		//control if the two password are the same
		if($newpassword1 <> $newpassword2){
			//the two password don't match
			echo "Veuillez ressaisir le même mot de passe dans les deux champs.<br />";
			echo "<meta http-equiv='refresh' content='2;".$tld."/user/passwordreset.php' />";
			}
			else
			{
			//the two passwords match
			$newpassword1 = md5($newpassword1);
			$sql = "UPDATE `".$tprefix."_users` SET `password`='".$newpassword1."' WHERE `user_id` = ".$_SESSION['UserId'];
			//debug
			//echo 'query  = '.$updateQuery;
			if(!$db->query($sql)){
				printf("Errormessage: %s\n", $db->error);
			}
			

			
			echo "<div class=\"backtoprofile\">Mise à jour réussie.<br /><a href=\"".$tld."user/".$_SESSION['Username']."\">Retour vers votre profil</a></div>";
					
			}
		}
	else
	{
	//any of the two is not filled ask to fill the two
	
		echo "Veuillez remplir les deux champs.<br />";
		echo "<meta http-equiv='refresh' content='2;".$tld."/user/passwordreset.php />";
	}
}
else {
//code executed if the user is not logged in
		echo "<meta http-equiv='refresh' content='2;".$tld."/user/login.php />";
}

?>
</body></html>