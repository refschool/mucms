<?php
//this file adds a row into links table
include('../../inc/config.php');include('../class/manager.class.php');

$action = $_POST['action'];
$id = $_POST['id'];


$myMan = new Manager();

	$last_link_id = $myMan->getLatestLinkId();
	if($action=='delete'){
	//delete entry
	preg_match('/[0-9]+/',$id,$m);
	$id = $m[0];
	$sql = "delete from `".$tprefix."_links` where `link_id` = '$id' limit 1";
	$db->query($sql);
	
	}
	
	if($action == 'add'){
	//create the entry
	$sql = "insert into `".$tprefix."_links` (`link_id`) values ('$last_link_id')";
	$db->query($sql);

	/* JSON */
	echo '{ "link_id": "'.$last_link_id.'" }';

}
