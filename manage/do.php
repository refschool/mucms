<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("config.php");

	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Update of Record</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-15">
</head>
	
<?php

	
$txt = trim($_POST['main_text']);echo mb_detect_encoding($txt);
$txt2 = $txt;


$txt = utf8_decode($txt);
$postid = trim($_POST['postid']);

/*$txt = 'decoration des ongles nail art fff';
$postid = 15; */

$sql = "update `$tprefix"."_content` set `main_text` = '$txt' where `id` = '$postid'";


$db->query($sql);
//echo $txt2;
echo '=============';
echo mb_detect_encoding($txt);
echo $sql;
//echo json_encode(array("sql"=> $sql ));