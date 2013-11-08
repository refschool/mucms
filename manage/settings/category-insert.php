<?php session_start();
include("../adminpc/inc/config.php");

$parent_id = trim($_POST['parent_id']);

$cat_label = strtolower(trim($_POST['cat_label']));

$datetime = date('Y-m-d H:i:s');

for($i=0;$i<count($lang);$i++){
	
	$sql = "insert into `".$tprefix."_category` (`parent_id`,`cat_label`,`datetime`) values ($parent_id','$cat_label','$datetime')";
	echo $sql.'<br>';
	//$db->query($sql);
	//$cat_id = $db->insert_id;
}


//  create the meta_id
$path = $tld.'/category/'.$cat_label;

$sql = "insert into `".$tprefix."_meta` (path, meta_canonical, type ) values ('$path','checked','category',)";
echo $sql . '<br>';
$db->query($sql);
$meta_id = $db->insert_id;


//update into ctegory table

$sql = "update `".$tprefix."_category` set meta_id = '$meta_id' where `cat_id` = '$cat_id'";
echo $sql . '<br>';
$db->query($sql);

////////////////////////////////////

echo "<meta http-equiv='refresh' content='".$redir_delay."; url=". $tld ."/manage/' >";