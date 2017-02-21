<?php session_start(); 
include ("../inc/config.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}

 $_SESSION = array(); session_destroy();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Logout Page</title>
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
	<div class="uk-container">
		<div class="uk-width-1-1 center-login" >
			<div class="uk-alert-success" uk-alert style="padding:1.5em">
				<a href="<?=$base_url?>/manage/write.php" />
					<div class="uk-card uk-card-default uk-card-body">
						<a href='index.php'>Now you are logged out, go to Login</a>
					</div>
				</div>
			</div>
		</div>
</body>
</html>