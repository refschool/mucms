<?php
ini_set("include_path", ".:../:./inc:../inc:../../inc");
include("config.php");include("class/manager.class.php");include("class/manager-functions.php");

$newcat = strtolower(trim($_POST['newcat']));

if($newcat == ''){
	echo 'category is empty !';exit;
}

//replace blank space with '-'
$newcat = str_replace(' ','-',$newcat);

//check duplicate
$duplicate = check_duplicate_category($newcat);
if($duplicate){echo 'category exists already'; exit;}

//everything is ok proceed to write DB
$datetime = date('Y-m-d H:i:s');
$query_string = "/category/$newcat/";
$path = $tld2 . $query_string;

//create meta_id
$sql = "insert into `$tprefix"."_meta` (`query_string`,`path`,`meta_canonical`,`type`) values ('$query_string','$path','checked','category')";echo $sql .'<br>';
$db->query($sql);
//get_meta_id
$meta_id = get_category_meta($query_string);

//
$sql = "insert into `$tprefix"."_category` (`cat_label`,`parent_id`,`meta_id`,`datetime`) values ('$newcat','1','$meta_id','$datetime')";echo $sql .'<br>';
$db->query($sql);

$redirect = $tld."manage/settings/index.php"; echo "Redirecting to : " . $redirect;

echo "<meta http-equiv='refresh' content='0; url=$redirect'>";