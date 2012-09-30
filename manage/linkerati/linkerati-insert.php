<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("config.php");include("class/manager.class.php");



	$site_url_id = trim($_POST['site_url_id']);
	$external_url = trim($_POST['external_url']);
	$anchor = trim($_POST['anchor']);
	$rel = trim($_POST['rel']);
	$pagerank = trim($_POST['pagerank']);
	$link_type = trim($_POST['link_type']);
	$date = trim($_POST['date']);
	
	
	$sql = "insert into `$tprefix"."_linkerati` (`external_url`,`rel`,`pagerank`,`link_type`,`date`) values ('$external_url','$rel','$pagerank','$link_type','$date')";echo $sql;
	
	$db->query($sql);
	echo "<meta http-equiv='refresh' content='0; url=$tld"."manage/linkerati/index.php'>";
	