<?php
//this file saves the AJAX 
include("../../inc/config.php");

	//fetch POST variables
	$value = trim($_POST['value']);	
	$id = trim($_POST['id']);

	
	
	$type = substr($id,0,5);//echo 'type = ' .$type;
	preg_match('/[0-9]+/i', $id , $m);
	$id =  $m[0];//echo 'id = ' . $id;


switch($type){

	case 'paged':
	$sql = "update `".$tprefix."_linkbuilding` set `page_id` = '$value' where `inlink_id` = '$id'";
	$db->query($sql);
	break;
	
	case 'sourc':
	$sql = "update `".$tprefix."_linkbuilding` set `source_url` = '$value' where `inlink_id` = '$id'";
	$db->query($sql);
	break;


	case 'ancho':
	$sql = "update `".$tprefix."_linkbuilding` set `anchor` = '$value' where `inlink_id` = '$id'";//echo $sql;
	//$db->query($sql);
	break;
	case 'ltype':
	$sql = "update `".$tprefix."_linkbuilding` set `link_type` = '$value' where `inlink_id` = '$id'";
	$db->query($sql);
	break;
	
	case 'misce':
	$sql = "update `".$tprefix."_linkbuilding` set `misc` = '$value' where `inlink_id` = '$id'";
	$db->query($sql);
	break;

}

echo $value;