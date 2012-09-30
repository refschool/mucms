<?php session_start();
include ("../inc/config.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Changement de mote de passe<?php echo ' | '.$tUrl; ?></title>
<meta name="robots" content="noindex,nofollow" />
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>


<body>
<div id="container">
<h2>Connexion</h2>


<?php
//code executed if user is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
?>
<form method="post" action="updatepassword.php" name="passwordupdateform" id="passwordupdateform">
	<table class="centered-table">
		<tr><td class="vform"><label for="newpassword1">Nouveau mot de passe</label><input class="bg" type="password" name="newpassword1" id="newpassword1" /></td></tr>
		<tr><td class="vform"><label for="newpassword2">Confirmation du nouveau mot de passe</label><input class="bg" type="password" name="newpassword2" id="newpassword2" /></td></tr>
		<tr><td class="vform"><input class="btn" type="submit" name="updatepassword" id="updatepassword" value="Nouveau Mot de Passe" /></td></tr>
	</table>
	</form>



<?php
	
}

//code executed if user process after submit of login & password
elseif(!empty($_POST['username']) && !empty($_POST['password']))
{
?>


<?php
//mysql_real_escape_string() removed 
// !!!!strip tags !
	$username = $_POST['username'];
	$password = md5(trim($_POST['password']));
	$sql = "SELECT `user_id`,`username` FROM `".$tprefix."_users` WHERE `username` = '".$username."' AND `password`= '".$password."' AND `act_stat`='A'";
	//echo $sql;
	$checklogin = $db->query($sql);
    
    if(mysqli_num_rows($checklogin) == 1)
    {
    	
			while($row = $checklogin->fetch_array()){
			$userid = $row['user_id'];
			$username = $row['username'];
			}
			//fetch useerid for faster sql query
			$_SESSION['UserId'] = $userid;
			$_SESSION['Username'] = $username;
		    $_SESSION['LoggedIn'] = 1;
       
       //login success
			//echo 'Success : '.$_SESSION['Username'];
			echo "<meta http-equiv='refresh' content='1;".$tld."/user/".$_SESSION['Username']." />";
		}
    else
    {
    //login error
				echo $username.' '.$userid;
    	  echo "<h1>Erreur</h1>";
        echo "<p>Désolé, le nom utilisateur et le mot de passe ne correspondent pas. <a href=\"".$tld."/user/login.php\">Veuillez recommencer</a>.</p>";
    }
}
else
{
	?>
	
<form method="post" action="login.php" name="loginform" id="loginform">
	<table class="centered-table">
		<tr><td class="vform"><label for="username">Nom utilisateur</label><input class="bg" type="text" name="username" id="username" /></td></tr>
		<tr><td class="vform"><label for="password">Mot de passe</label><input class="bg" type="password" name="password" id="password" /></td></tr>
		<tr><td class="vform"><input class="btn" type="submit" name="login" id="login" value="" /></td></tr>
	</table>
	</form>
<?php

}
?>
</div>


</body>
</html>