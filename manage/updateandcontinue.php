<?php session_start();

 include("../inc/config.php"); 
 include("inc/php/manager-functions.php");
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Update Post</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<?php
/*
 *   Retrieve the POST variable content
 */
 //--content table variable
$id = $_POST['id'];
$meta_id = $_POST['meta_id'];


//pretty($_POST);

if(get_magic_quotes_gpc () == 1){
	$title = $_POST['title'];
}
else {
	$title = addslashes($_POST['title']);
}


//fix this for good !!
$path = trim($_POST['thisurl']);

// if(get_magic_quotes_gpc () == 1){
// 	$h1_title = $_POST['h1_title'];
// }
// else {
// 	$h1_title = addslashes($_POST['h1_title']);
// }



if(get_magic_quotes_gpc () == 1){
	$author = $_POST['author'];
}
else {
	$author = addslashes($_POST['author']);
}



$date_posted= $_POST['date_posted'];



if(get_magic_quotes_gpc () == 1){
$social_body_text = $_POST['social_body_text'];
}
else {
$social_body_text = addslashes(trim(($_POST['social_body_text'])));
}


if(get_magic_quotes_gpc () == 1){
$main_text = $_POST['main_text'];
}
else {
$main_text = addslashes(trim(($_POST['main_text'])));
}

//$lang = $_POST['lang'];
$lang = (isset($_POST['lang']) ?  $_POST['lang'] : 'fr');


$readmore = addslashes(trim($_POST['readmore']));
$published = $_POST['published'];

$com_closed = '';
if(isset($_POST['com_closed'])){
	$com_closed = $_POST['com_closed'];
}

if(get_magic_quotes_gpc () == 1){
$note = trim($_POST['post_note']);
}
else {
$note = addslashes(trim(($_POST['post_note'])));
}


//--category table variable
$category = $_POST['category'];
//--tags**********
$tagstring = $_POST['tag'];

//--meta table information ********
$redirect = $_POST['redirect'];
$redirect_type = $_POST['redirect_type'];

$meta_type = 'post';//new field in mucms 2.0
$meta_robotCANONICAL =(isset($_POST['meta_robotCANONICAL']) ?  $_POST['meta_robotCANONICAL'] : '');

//  noindex  = true if post is not published
if( $_POST['published'] == 'N'){
	$meta_robotNOINDEX = 'checked';
	//echo '<br>NO INDEX = '.$meta_robotNOINDEX ;
} 

if( $_POST['published'] == 'Y'){
	$meta_robotNOINDEX = '';
	//echo '<br>NO INDEX = '.$meta_robotNOINDEX ;
} 	



$meta_robotNOFOLLOW =(isset($_POST['meta_robotNOFOLLOW']) ?  $_POST['meta_robotNOFOLLOW'] : '');
$meta_robotNOARCHIVE =(isset($_POST['meta_robotNOARCHIVE']) ?  $_POST['meta_robotNOARCHIVE'] : '');
$meta_robotNOSNIPPET =(isset($_POST['meta_robotNOSNIPPET']) ?  $_POST['meta_robotNOSNIPPET'] : '');
$meta_robotNOODP =(isset($_POST['meta_robotNOODP']) ?  $_POST['meta_robotNOODP'] : '');
$meta_robotNOYDIR =(isset($_POST['meta_robotNOYDIR']) ?  $_POST['meta_robotNOYDIR'] : '');
$meta_googlebot =(isset($_POST['meta_googlebot']) ?  $_POST['meta_googlebot'] : '');



if(get_magic_quotes_gpc () == 1){
$description = $_POST['description'];
}
else {
$description = addslashes(trim(($_POST['description'])));
}

$keyword = $_POST['keyword'];

//--CONTENT TABLE UPDATE QUERY______________________
$update_content = "update `$tprefix"."_content` set 
`title`='$title',
`author`='$author',
`date_posted`='$date_posted',
`social_body_text`='$social_body_text',
`main_text`='$main_text',
`lang`='$lang',
`readmore`='$readmore',
`published`='$published',
`com_closed`='$com_closed',
`note`='$note' where `id`='$id'" ;

//echo 'yyy<br>'.$update_content;

$query_state = $db->query($update_content); 

if($query_state === TRUE){
	echo '<h1>The Query Was successful </h1>';}
	else {
		echo '<h1>The Query Failed </h1>'.$db->error;
	};

//--META TABLE UPDATE QUERY______________________
$update_meta = "update `$tprefix"."_meta` set 
`path` = '$path',
`redirect` = '$redirect',
`redirect_type` = '$redirect_type',
`meta_canonical` = '$meta_robotCANONICAL',
`meta_robot_index` = '$meta_robotNOINDEX',
`meta_robot_follow` = '$meta_robotNOFOLLOW',
`meta_robot_archive` = '$meta_robotNOARCHIVE',
`meta_robot_snippet` = '$meta_robotNOSNIPPET',
`meta_robot_odp` = '$meta_robotNOODP',
`meta_robot_ydir` = '$meta_robotNOYDIR',
`meta_googlebot` = '$meta_googlebot',
`description` = '$description',
`keyword` = '$keyword',
`type` = 'post'
 where `meta_id` = '$meta_id' ";

 //echo 'update xxx '.$update_meta;
 
$db->query($update_meta);


//--CATEGORY PROCESSING______________________
// process category table


//process association
	//echo '<h2>Category TREE (cat_id)</h2>';	
	//echo '<pre>';print_r($category);echo '</pre>';


	
	//first delete categories attached to the product
	$sql_del_cat_post = "delete from `$tprefix"."_cat_post` where `post_id` = '$id'";
	$db->query($sql_del_cat_post);
	//echo '<br> delete cat_post ' . $sql_del_cat_post;
	
	//and then reinsert the category-product pairs
	for($i=0;$i<count($category);$i++){
		$sql = "insert into `$tprefix"."_cat_post` (`cat_id`,`post_id`) values ('".$category[$i]."','" . $id . "') ";
		$db->query($sql);
		//echo '<br>cat_post table update : ' .$sql;
	
	
	}
//echo '<h2>======= TAG SECTION ============</h2>';

//--TAGS TABLE UPDATE QUERY______________________
// process tag strings

/*
* 1 - add cms level new tags
* 2 - delete existing tag post association
* 3 - add new tag post association
* DONE
*/


//only add tags,
//do not remove tags from CMS when there is no tag-post association
//
	//trim spaces
	if(!empty($tagstring)){
		$tagstring = str_replace(' ','',$tagstring);
		//echo $tagstring ;
		$tags = explode(',',$tagstring);
		sort($tags);
		
		echo '<h2>identified tags from the form field</h2>';
		pretty($tags);	

	add_cms_tags($tags);

	//now that we know which tags are sent from the form
	//attach them to the post
	//delete current tag_post association
	//
	remove_tag_post_association($id);

	add_tag_post_association($tags,$id);
	}
//echo '<h2>======= END  TAG SECTION ============</h2>';
//END OF METADATA PROCESSING


//update the sitemap
// build_sitemap();

echo "<meta http-equiv='refresh' content='1; url=write.php?id=$id'>";
$db->close();
?>

