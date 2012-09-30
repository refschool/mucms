<?php
include("../inc/config.php");
$action = $_POST['action'];
$id = $_POST['id'];



if($action == 'delete'){
	preg_match('/[0-9]+/',$id,$m);
	$id = $m[0];
	$sql = "delete from `$tprefix"."_links` where `link_id` = '$id' ";
	$db->query($sql);
}

if($action == 'add'){
	
	$sql = "select max(`link_id`)+1 M from `$tprefix"."_links` limit 1";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$max = $row['M'];
	
	$sql2 = "insert into `$tprefix"."_links` (`link_id`) values ('$max')";
	$db->query($sql2);
	//format JSON
	//$max = '666';
	echo '{ "link_id" :"'.$max.'" }';

}