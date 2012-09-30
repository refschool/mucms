<?php session_start();
 include ("../inc/config.php");include("class/user.class.php");
 //create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}

	$username = $_GET['username'];
	$myUser = new User(); ?>
<?php
//code executed if owner is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Profil Privé <?php echo ' | '.$tUrl ;?> </title>
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>

<body>
<div id="superframe">
<div id="frame">

<?php
echo "<div id=\"mini-header\">\n";
//

echo '<div id="logout"><a href="' . $tld . 'user/logout.php"><strong>Logout</strong></a></div>';
echo '<div id="greeting">Bonjour <strong>'.$username.'</strong>,</div>';
//menu
echo "</div>";
//Vos informations
if($myUser->account_not_active($username)){
	echo '<img src="warning.jpg" width="20" height="20" />Activez votre compte<br /><br />';
}
//display the user email
//===================================================

$privateemail = "SELECT `email` FROM `$tprefix"."_users` WHERE `user_id` = ".$_SESSION['UserId'];
//echo $privateemail;
$result = $db->query($privateemail);
	if($result){
	$row = $result->fetch_assoc();
	$email = $row["email"];
	
	echo '<table class="profile-table"><tr><td colspan="2" class="profile-title">Vos données de contact</td></tr>';	
	echo '<tr><td class="profile-label">Email</td><td class="profile-data">'. $email.'</td></tr>'; 
	echo '</table>';


}//end of user email display



//Changement mot de passe
//===================================================
echo '<table class="profile-table"><tr><td colspan="2" class="profile-title">Changez votre mot de passe</td></tr>';	
echo '<tr><td colspan="2" class="profile-link"><a href="'.$tld . 'user/passwordreset.php">Changer de mot de passe</a></td></tr></table>';


}

else 
{
//the user is not logged in , display public information
//===================================================
header ('Location : '.$tld . 'public/'.$username);
}
?>


</div>
</div>
</body>
</html>