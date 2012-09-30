<?php session_start();

 include("../inc/config.php"); 
 include("class/manager.class.php");
 include("class/manager-functions.php");
 
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Update Post</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
</head>
<?php
/*
 *   Retrieve the POST variable content
 */
 //--content table variable
$id = $_POST['id'];
$meta_id = $_POST['meta_id'];

$title = $_POST['title'];
$query_string = trim($_POST['thisurl']);
	//process query_string according to old style url (pre 2.4 mucms version) remove first slash
	$first_slash_pos = strpos($query_string,'/');
	if($first_slash_pos == 0){
		
		$path = $tld2 . $query_string;
		} 
		else 
		{
		
		$path = $tld . $query_string;
		}

$h1_title = $_POST['h1_title'];
$author = $_POST['author'];
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
$lang = (isset($_POST['lang']) ?  $_POST['lang'] : $lang);


$readmore = $_POST['readmore'];
$published = $_POST['published'];

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
$meta_robotNOINDEX =(isset($_POST['meta_robotNOINDEX']) ?  $_POST['meta_robotNOINDEX'] : '');
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
`h1_title`='$h1_title',
`author`='$author',
`date_posted`='$date_posted',
`social_body_text`='$social_body_text',
`main_text`='$main_text',
`lang`='$lang',
`readmore`='$readmore',
`published`='$published',
`note`='$note' where `id`='$id'" ;echo $update_content;

$query_state = $db->query($update_content); 
if($query_state === TRUE){echo '<h1>The Query Was successful </h1>';} else {echo '<h1>The Query Failed </h1>'.$db->error;};

//--META TABLE UPDATE QUERY______________________
$update_meta = "update `$tprefix"."_meta` set 
`query_string` = '$query_string',
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
 where `meta_id` = '$meta_id' ";echo $update_meta;
 
$db->query($update_meta);


//--CATEGORY PROCESSING______________________
// process category table


//process association
	echo '<h2>Category TREE (cat_id)</h2>';	
	echo '<pre>';print_r($category);echo '</pre>';


	
	//first delete categories attached to the product
	$sql_del_cat_post = "delete from `$tprefix"."_cat_post` where `post_id` = '$id'";
	$db->query($sql_del_cat_post);
	echo '<br> delete cat_post ' . $sql_del_cat_post;
	
	//and then reinsert the category-product pairs
	for($i=0;$i<count($category);$i++){
		$sql = "insert into `$tprefix"."_cat_post` (`cat_id`,`post_id`) values ('".$category[$i]."','" . $id . "') ";
		$db->query($sql);echo '<br>cat_post table update : ' .$sql;
	
	
	}

//--TAGS TABLE UPDATE QUERY______________________
// process tag strings

/*
* 1 - add cms level new tags
* 2 - add post level new tags
* 3 - remove post level deprecated tags
* 4 - remove cms level deprecated tags
*/


echo '<h2>======= TAG SECTION ============</h2>';
	//trim spaces
	if(!empty($tagstring)){
	$tagstring = str_replace(' ','',$tagstring);//echo $tagstring ;
	$tags = explode(',',$tagstring);
	sort($tags);
	
	echo '<h2>identified tags from the form field</h2>';
	pretty($tags);	

	}
	
	if(!empty($tags)){	
	
		$cms_existing_tags = get_existing_tags();
		echo '<h2>Current tags in CMS </h2>';
		pretty($cms_existing_tags);		
		;
		
		
		$existing_post_tags = get_post_tags($id);
		echo '<h2>Current tags for this POST</h2>';		
		 pretty($existing_post_tags);


		if(!empty(	$cms_existing_tags)){
		$tags_to_add_to_cms = array_diff($tags,$cms_existing_tags);sort($tags_to_add_to_cms);
		echo '<h2>Tag to add to CMS </h2>';

		 pretty($tags_to_add_to_cms);
		 
			} else {
			$tags_to_add_to_cms = $tags;
			
			}
		//===============================================

			$tags_to_add_to_post = array_diff($tags,$existing_post_tags);
			sort($tags_to_add_to_post);
			echo '<h2>Tag to add to POST </h2>';
			pretty($tags_to_add_to_post);
	

		
			$tags_to_delete_from_post = array_diff($existing_post_tags,$tags);sort($tags_to_delete_from_post);	
			echo '<h2>Tag to delete from POST</h2>';
			pretty($tags_to_delete_from_post);


	/*
	 * ADD TAGS
	*/
	
	
		//if tag is new to cms
		if(count($tags_to_add_to_cms) > 0){
			add_cms_tags($tags_to_add_to_cms);//add to tags and meta table
		}
		
		//  !IMPORTANT
		//if tag is new to post then add the binding between tag id and post id
		if(count($tags_to_add_to_post) > 0){
			add_tag_post_association($tags_to_add_to_post,$id);//add to tags and meta table
		}
		
		//if tag is removed from post
		if(count($tags_to_delete_from_post) > 0){
			remove_tag_post_association($tags_to_delete_from_post,$id);//add to tags and meta table
		}
		
		//if tag not used in CMS
		
		$active_tags = get_active_tags();
		
		echo '<h2>Active tags </h2>';
		pretty($active_tags);


		if(!empty(	$cms_existing_tags)){
		$tags_to_delete_from_cms = array_diff($cms_existing_tags,$active_tags);sort($tags_to_delete_from_cms);
		echo '<h2>Tag to delete from CMS </h2>';
	
		} 	
				
		if(count($tags_to_delete_from_cms) > 0){
			remove_cms_tags($tags_to_delete_from_cms);//add to tags and meta table
		}		

	}

echo '<h2>======= END  TAG SECTION ============</h2>';

	
//END OF METADATA PROCESSING


//update the RSS Feed
build_rss();
//update the sitemap
build_sitemap();

echo "<meta http-equiv='refresh' content='5; url=$tld"."manage/write.php?id=$id'>";
$db->close();
?>

