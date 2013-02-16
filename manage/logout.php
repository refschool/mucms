<?php session_start(); 
$username = $_SESSION['Username'];
include ("../inc/config.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}

 $_SESSION = array(); session_destroy();?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Logout of Manager</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>
<body>


<?php
echo "<div class=\"backtoprofile\">Now you are logged out<br /></div>";
echo "<meta http-equiv='refresh' content='".$redir_delay.";".$tld.$install_folder."/manage/' />";
 ?>
</body>
</html>