<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
 include("config.php"); include("class/manager.class.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	} 
	
	
$robots = trim($_POST['robots']);
$file = '../../robots.txt';
$handle = fopen($file,'w');
fwrite($handle,$robots);

$redirect = $tld."manage/seo/seo.php"; echo "Redirecting to : " . $redirect;

echo "<meta http-equiv='refresh' content='0; url=$redirect'>";