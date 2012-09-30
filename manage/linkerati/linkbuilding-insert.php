<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("config.php");include("class/manager.class.php");



	$page_id = trim($_POST['page_id']);
	$source_url = trim($_POST['source_url']);
	
	$anchor = trim($_POST['anchor']);
	$rel = trim($_POST['rel']);
	
	
	//$pagerank = pr($source_url);
	
	
	$link_type = trim($_POST['link_type']);
	$date = trim($_POST['date']);
	$misc = trim($_POST['misc']);
	
	
	$sql = "insert into `$tprefix"."_linkbuilding` (`page_id`,`source_url`,`anchor`,`rel`,`pagerank`,`link_type`,`date`,`misc`) values ('$page_id','$source_url','$anchor','$rel','$pagerank','$link_type','$date','$misc')";echo $sql;
	
	$db->query($sql);
	echo "<meta http-equiv='refresh' content='0; url=$tld"."manage/linkerati/index.php'>";
	