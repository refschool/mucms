<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
 include("config.php"); include("class/manager.class.php");
 
 
 
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	} 
	
$topic = trim($_POST['topic']);	
$post_id = trim($_POST['post_id']);	
$url = trim($_POST['url']);	
$alt = trim($_POST['alt']);	
$anchor = trim($_POST['anchor']);
$misc = trim($_POST['misc']);

//$link_id = getLatestLinkId();

$sql = "insert into `".$tprefix."_links` (`post_id`,`topic`,`url`,`alt`,`anchor`,`misc`) 
values ('$post_id','$topic','$url','$alt','$anchor','$misc')";echo $sql;

$db->query($sql);

$redirect = $tld."manage/settings/index.php"; echo "Redirecting to : " . $redirect;

echo "<meta http-equiv='refresh' content='2; url=$redirect'>";