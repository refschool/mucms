<?php session_start();
 include ("../inc/config.php");
 include("inc/php/manager-functions.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manager </title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="inc/css/manager.css" />
<script type="text/javascript" src="<?=$base_url?>/manage/inc/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="<?=$base_url?>/manage/inc/js/script.js"></script>
<link type="text/css" href="js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
<script src="<?=$base_url."/manage/lib/tinymce/js/tinymce/tinymce.min.js"?>"></script>
<link rel="stylesheet" href="<?=$base_url."/inc/uikit/css/uikit.min.css" ?>"/>


<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<?php
 //code executed if owner is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
?>

<div class="uk-container">
	<div class="uk-width-1-1 center-login" >
			<div class="uk-alert-success" uk-alert style="padding:1.5em">
				<a href="<?=$base_url?>/manage/write.php" />Go To Admin</a>
			</div>
	</div>
</div>

<?php
}

elseif(!empty($_POST['username']) && !empty($_POST['password'])){
	$username = $_POST['username'];
	$password = md5(trim($_POST['password']));
	
	$sql = "SELECT `user_id`,`username`,`level` FROM `$tprefix"."_users` WHERE `username` = '".$username."' AND `password`= '".$password."' AND `act_stat`='A'";
	
	$checklogin = $db->query($sql);
	
	   if(mysqli_num_rows($checklogin) == 1){
    	
			while($row = $checklogin->fetch_array()){
			$userid = $row['user_id'];
			$username = $row['username'];
			$userlevel = $row['level'];
			}
			//fetch userid for faster sql query
			$_SESSION['UserId'] = $userid;
			$_SESSION['Username'] = $username;
			$_SESSION['Userlevel'] = $userlevel;
			echo 'user level = '. $_SESSION['Userlevel'];
		    $_SESSION['LoggedIn'] = 1;
			
			if($_SESSION['Userlevel'] == 'admin'){
			echo "<meta http-equiv='refresh' content='0;".$_SESSION['returnPath']."' />";
			}
			else {

?>
<div class="uk-container">
	<div class="uk-width-1-1 center-login">
		<div style="margin-left:20%;margin-right:20%">
			<div class="uk-alert-warning" uk-alert>
				<p>Vous n'avez pas les droits suffisants pour éditer !</p>
				<p><a href="/">Retour</a></p>
				<p><a href="/manage/logout.php">Logout</a></p>
			</div>
		</div>
	</div>
</div>

<?php

			}
		}
		else {
		
		echo 'Login or password not correct please try again';
		echo "<meta http-equiv='refresh' content='1;'/manage/index.php' />";
		}
}

//not logged in
else {
?>

<div class="uk-container">
	<div class="uk-width-1-1 center-login">
			<form class="uk-form" method="post" action="index.php" name="loginform" id="loginform">
				<label for="username">Login</label>
				<input class="uk-input" type="text" name="username" id="username" /><br />
				<label for="password">Password</label>
				<input class="uk-input" type="password" name="password" id="password" /><br /><br />
				<input class="uk-input" type="submit" name="login" id="login" value="Login" /><br />
				<a href="<?=$base_url?>/user/requestpassword.php">Mot de passe oublié?</a>
			</form>
	</div>
</div>
<?php
}
?>

