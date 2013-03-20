<?php session_start();

include("../../inc/config.php");
include("../../inc/debug-functions.php");
include('../inc/dir-functions.php');
include('../inc/dir-bo-functions.php');


$entry_id = $_POST['entry_id'];
$cat_id = $_POST['cat_id'];
$website_name = addslashes(trim($_POST['website_name']));
$website_url = addslashes(trim($_POST['website_url']));
$email = addslashes(trim($_POST['email']));

$short_desc = addslashes(trim($_POST['short_desc']));
$long_desc = addslashes(trim($_POST['long_desc']));




$street = addslashes(trim($_POST['street']));
$street2 = addslashes(trim($_POST['street2']));
$postcode = addslashes(trim($_POST['postcode']));
$city = addslashes(trim($_POST['city']));
$country = addslashes(trim($_POST['country']));
$phone = addslashes(trim($_POST['phone']));

$twitter = addslashes(trim($_POST['twitter']));
$facebook = addslashes(trim($_POST['facebook']));

$backlink_page = addslashes(trim($_POST['backlink_page']));

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
