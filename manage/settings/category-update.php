<?php
include("../adminpc/inc/config.php");

$category_id = $_POST['category_id'];
$parent_id = $_POST['parent_id'];
$lang = $_POST['lang'];
$order = $_POST['order'];
$category_name = addslashes(trim($_POST['category_name']));
$category_description = addslashes(trim($_POST['category_description']));
$status = $_POST['status'];if($status == ''){ $status = 'I';}

$sql = "update `categories_lang` set `category_name` = '$category_name' , `category_description` = '$category_description',`order` = '$order',`parent_id` = '$parent_id', `status` = '$status' where `category_id` = '$category_id' and `lang` = '$lang'";
echo $sql;

//$db->query("SET CHARACTER SET utf8");
$db->query($sql);

// disable child categories
//disable_child_categories($category_id);


redirect_to($tld . '/adminpc/categories.php',$redir_delay);

//echo "<meta http-equiv='refresh' content='".$redir_delay."; url=". $tld ."/adminpc/categories.php' >";