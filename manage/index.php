<?php session_start();
 include ("../inc/config.php");


 //code executed if owner is logged in
if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Manager </title>
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>
<?php

echo 'you are logged in';
echo 'loggedIn = '. $_SESSION['LoggedIn'].'<br>';
echo 'Username = '. $_SESSION['Username'].'<br>';
echo "<meta http-equiv='refresh' content='0;".$tld2. "/manage/write.php' />";	
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
			//echo 'Success : '.$_SESSION['Username'];
			echo "<meta http-equiv='refresh' content='0;".$_SESSION['returnPath']."' />";
			}
			else {
				
				echo "Vous n'avez pas les droits suffisants pour éditer !<br> ";
				echo '<a href="'.$tld2."/".$install_folder.'">Retour</a><br>';
				echo '<a href="'.$tld2."/".$install_folder.'manage/logout.php">Logout</a>';	
				
			}
		}
		else {
		
		echo 'Login or password not correct please try again';
		echo "<meta http-equiv='refresh' content='1;$tld2"."/".$install_folder."/manage/index.php' />";
		}
}

//not logged in
else {
?>

<form method="post" action="index.php" name="loginform" id="loginform">
	<table class="centered-table">
		<tr><td class="vform"><label for="username">Login</label><input class="bg" type="text" name="username" id="username" /></td></tr>
		<tr><td class="vform"><label for="password">Password</label><input class="bg" type="password" name="password" id="password" /></td></tr>
		<tr><td class="vform"><input class="btn" type="submit" name="login" id="login" value="Login" /></td></tr>
		<tr><td><a href="<?=$tld2 . $install_folder?>/user/requestpassword.php">Mot de passe oublié?</a></td></tr>
	</table>
	</form>

<?php
}
?>

