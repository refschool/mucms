<?php session_start();
include ("../inc/config.php");include("class/user.class.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Connexion<?php echo ' | '.$tUrl; ?></title>
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>


<body>
<div id="container">
<tr><h2>Connexion</h2></tr>


<?php
//code executed if user is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
	echo "<div class=\"backtoprofile\">Authentification réussie<br /><a href=\"$tld"."user/".$_SESSION['Username']."\">Aller vers votre profil</a></div>";
	

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
	$sql = "SELECT `user_id`,`username` FROM `$tprefix"."_users` WHERE `username` = '".$username."' AND `password`= '".$password."' AND `act_stat`='A'";

	$checklogin = $db->query($sql);
	
   if(mysqli_num_rows($checklogin) == 1)
    {
    	
			while($row = $checklogin->fetch_array()){
			$userid = $row['user_id'];
			$username = $row['username'];
			}
			//fetch userid for faster sql query
			$_SESSION['UserId'] = $userid;
			$_SESSION['Username'] = $username;
		    $_SESSION['LoggedIn'] = 1;
       

		echo "post log";
	   
			//echo 'Success : '.$_SESSION['Username'];
			echo "<meta http-equiv='refresh' content='0;$tld"."user/".$_SESSION['Username']."' />";			


		}
    else
    {
    //error on login wrong password or else, authentify again

    ?>
	<div class="backtoprofile">Désolé, le nom utilisateur et le mot de passe ne correspondent pas.<br /><a href="<?php echo $tld ; ?>user/login.php">Veuillez recommencer</a>.<br style="clear:both" />
<p>Si vous êtes sûr d'avoir un compte actif envoyer email à <?=$masteremail?></p>
	
	</div>		


	<?php
	
    }
}
else
{

/*
 *   tip is used when user come from password reset email
 */
	?>
	
<form method="post" action="login.php" name="loginform" id="loginform">
	<table class="centered-table">
		<tr><td class="vform"><label for="username">Nom utilisateur</label><input class="bg" type="text" name="username" id="username" /></td></tr>
		<tr><td class="vform"><label for="password">Mot de passe</label><input class="bg" type="password" name="password" id="password" /></td></tr>
		<tr><td class="vform"><input class="btn" type="submit" name="login" id="login" value="Login" /></td></tr>
		<tr><td><a href="<?php echo $tld;?>user/requestpassword.php">Mot de passe oublié?</a></td></tr>
	</table>
	</form>
<?php

}
?>
</div>
</body>
</html>