<?php session_start();

include("../../inc/config.php");
include("../../inc/debug-functions.php");
include('../inc/dir-functions.php');
include('../inc/dir-bo-functions.php');


$entry_id = $_POST['entry_id'];


$cat_id = $_POST['cat_id'];


if(get_magic_quotes_gpc () == 1){
	$website_name = trim($_POST['website_name']);
} else {
	$website_name = addslashes(trim($_POST['website_name']));	
}


if(get_magic_quotes_gpc () == 1){
	$website_url = trim($_POST['website_url']);
} else {
	$website_url = addslashes(trim($_POST['website_url']));
}

if(get_magic_quotes_gpc () == 1){
	$email = trim($_POST['email']);
} else {
	$email = addslashes(trim($_POST['email']));
}



if(get_magic_quotes_gpc () == 1){
	$short_desc = trim($_POST['short_desc']);
} else {
	$short_desc = addslashes(trim($_POST['short_desc']));
}


if(get_magic_quotes_gpc () == 1){
	$long_desc = trim($_POST['long_desc']);
} else {
	$long_desc = addslashes(trim($_POST['long_desc']));
}


if(get_magic_quotes_gpc () == 1){
	$street = trim($_POST['street']);
} else {
	$street = addslashes(trim($_POST['street']));	
}


if(get_magic_quotes_gpc () == 1){
	$street2 = trim($_POST['street2']);
} else {
	$street2 = addslashes(trim($_POST['street2']));
}

if(get_magic_quotes_gpc () == 1){
	$postcode = trim($_POST['postcode']);
} else {
	$postcode = addslashes(trim($_POST['postcode']));
}

if(get_magic_quotes_gpc () == 1){
	$city = trim($_POST['city']);
} else {
	$city = addslashes(trim($_POST['city']));
}

if(get_magic_quotes_gpc () == 1){
	$country = trim($_POST['country']);
} else {
	$country = addslashes(trim($_POST['country']));	
}

if(get_magic_quotes_gpc () == 1){
$phone = trim($_POST['phone']);
} else {
$phone = addslashes(trim($_POST['phone']));
}


if(get_magic_quotes_gpc () == 1){
	$twitter = trim($_POST['twitter']);
} else {
	$twitter = addslashes(trim($_POST['twitter']));
}

if(get_magic_quotes_gpc () == 1){
	$facebook = trim($_POST['facebook']);
} else {
	$facebook = addslashes(trim($_POST['facebook']));
}

if(get_magic_quotes_gpc () == 1){
	$backlink_page = trim($_POST['backlink_page']);
} else {
	$backlink_page = addslashes(trim($_POST['backlink_page']));
}

if(get_magic_quotes_gpc () == 1){
	$msg = trim($_POST['msg']);
} else {
	$msg = addslashes(trim($_POST['msg']));
}


//choose the action
/***
 *      _    _ _____  _____       _______ ______  __          ________ ____   _____ _____ _______ ______ 
 *     | |  | |  __ \|  __ \   /\|__   __|  ____| \ \        / /  ____|  _ \ / ____|_   _|__   __|  ____|
 *     | |  | | |__) | |  | | /  \  | |  | |__     \ \  /\  / /| |__  | |_) | (___   | |    | |  | |__   
 *     | |  | |  ___/| |  | |/ /\ \ | |  |  __|     \ \/  \/ / |  __| |  _ < \___ \  | |    | |  |  __|  
 *     | |__| | |    | |__| / ____ \| |  | |____     \  /\  /  | |____| |_) |____) |_| |_   | |  | |____ 
 *      \____/|_|    |_____/_/    \_\_|  |______|     \/  \/   |______|____/|_____/|_____|  |_|  |______|
 *                                                                                                       
 *                                                                                                       
 */

if ($_POST['action'] == 'Update') {
    //action for update here
    echo 'Update';

$phone = addslashes(trim($_POST['phone']));

$sql = "update `$tprefix"."_dir_entry` set `cat_id` = '$cat_id', `website_name` = '$website_name', `website_url` = '$website_url', `email` = '$email',`short_desc` = '$short_desc',`long_desc` = '$long_desc',`street` = '$street',`street2` = '$street2',`postcode` = '$postcode',`city` = '$city',`country` = '$country',`phone` = '$phone',`twitter` = '$twitter',`facebook` = '$facebook',`backlink_page` = '$backlink_page' where `entry_id` = '$entry_id'";

echo $sql;
$db->query($sql);

/***
 *     __      __     _      _____ _____       _______ ______  __          ________ ____   _____ _____ _______ ______ 
 *     \ \    / /\   | |    |_   _|  __ \   /\|__   __|  ____| \ \        / /  ____|  _ \ / ____|_   _|__   __|  ____|
 *      \ \  / /  \  | |      | | | |  | | /  \  | |  | |__     \ \  /\  / /| |__  | |_) | (___   | |    | |  | |__   
 *       \ \/ / /\ \ | |      | | | |  | |/ /\ \ | |  |  __|     \ \/  \/ / |  __| |  _ < \___ \  | |    | |  |  __|  
 *        \  / ____ \| |____ _| |_| |__| / ____ \| |  | |____     \  /\  /  | |____| |_) |____) |_| |_   | |  | |____ 
 *         \/_/    \_\______|_____|_____/_/    \_\_|  |______|     \/  \/   |______|____/|_____/|_____|  |_|  |______|
 *                                                                                                                    
 *                                                                                                                    
 */


} else if ($_POST['action'] == 'Validate Website') {
    //action for delete
      echo 'Validate Website<br>';

//create the meta entry
//build the path, the path = sefurlize the site title
//lower case
$path = $tld . slug($website_name);

//
$sql = "insert into `$tprefix"."_meta` (`path`,`meta_robot_index`,`meta_canonical`,`description`,`type`) values ('$path','checked','checked','','directory')";

echo $sql.'<br>';
$db->query($sql);



$last_meta_id = $db->insert_id;
//update entry table with last inserted meta id

$sql = "update `$tprefix"."_dir_entry` set `meta_id`='$last_meta_id',`status` = 'approved' where `entry_id` = '$entry_id'";

echo $sql.'<br>';

//create the the entry in the meta table
$db->query($sql);

//modify the path by appending the meta id to the path
//
$path = $tld . $last_meta_id . '-' . slug($website_name) .'/';
$sql = "update `$tprefix"."_meta` set `path` = '$path' where `meta_id` = '$last_meta_id'";

echo $sql.'<br>';

$db->query($sql);


//SQL to validate the website

} else {
    //invalid action!
    echo 'Invalid !';
}








//END OF METADATA PROCESSING
echo "<META http-equiv='refresh' content='2; url=". $_SERVER['HTTP_REFERER']."'>";
$db->close();
