<?php session_start();
ini_set("include_path", ".:../:./inc:../inc:../../inc");
include("../inc/config.php");
include("class/manager-functions.php");

include("class/manager.class.php");

$post_id = $_GET['post_id'];
$com_id = $_GET['com_id'];

if(!empty($com_id)){
//delete single comment
$sql = "delete from `$tprefix"."_comments` where `comment_id` = '$com_id'";
//echo $sql;
$db->query($sql);

}
else {
//delete all spam of the post
$sql = "delete from `$tprefix"."_comments` where `status` = 'U' and `post_id` = '$post_id'";
//echo $sql;
$db->query($sql);
}

echo "<meta http-equiv='refresh' content='0; url=$tld2"."/manage/write.php?id=$post_id'>";