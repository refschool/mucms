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

	case 'postd':
	$sql = "update `".$tprefix."_links` set `post_id` = '$value' where `link_id` = '$id'";
	$db->query($sql);
	break;
	
	case 'topic':
	$sql = "update `".$tprefix."_links` set `topic` = '$value' where `link_id` = '$id'";
	$db->query($sql);
	break;
	
	case 'urloc':
	$sql = "update `".$tprefix."_links` set `url` = '$value' where `link_id` = '$id'";
	$db->query($sql);
	break;


	case 'alter':
	$sql = "update `".$tprefix."_links` set `alt` = '$value' where `link_id` = '$id'";//echo $sql;
	//$db->query($sql);
	break;
	case 'ancho':
	$sql = "update `".$tprefix."_links` set `anchor` = '$value' where `link_id` = '$id'";
	$db->query($sql);
	break;
	
	case 'misce':
	$sql = "update `".$tprefix."_links` set `misc` = '$value' where `link_id` = '$id'";
	$db->query($sql);
	break;

}

echo $value;