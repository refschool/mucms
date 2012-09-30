<?php

include("tag-functions.php");
include("category-functions.php");
include("browser-functions.php");
include("editor-functions.php");
include("comment-functions.php");
include("crawltrack-functions.php");
include("rss-functions.php");
include("sitemap-functions.php");

function pretty($array){
	echo '<pre>';print_r($array);echo '</pre>';
}

//creat a new post and insert information in the table content and meta and set uncategorized as default category
function create_post(){
	global $db,$tprefix,$tld;
	
		$today = date('Y-m-d H:m:s');

		//==========================================


		//create entry in meta table
		$new_meta_id = get_new_meta_id();echo 'new meta_id = '  . $new_meta_id.'<br>';
		$meta_sql = "INSERT INTO `$tprefix"."_meta` (`meta_id`,`path`,`meta_canonical`,`type`) VALUES ('$new_meta_id','$tld','checked','post')";echo $meta_sql.'<br>';


		//create entry in content table
		
		
		$new_post_id = get_latest_post_id();echo 'new post_id = '  . $new_post_id.'<br>';

		$content_sql = "INSERT INTO `$tprefix"."_content` (`id`,`meta_id`,`date_posted`,`published`,`author`,`title`) 
		VALUES ('$new_post_id', '$new_meta_id','$today' ,'N','$authorname','YOUR TITLE HERE')";echo $content_sql.'<br>';

		$db->query($meta_sql) or die('query failed');
		$db->query($content_sql) or die('query failed');

		
		
		//create entry in cat_post table

		//get the uncategorized cat_id
		$sql = "select `cat_id` from `$tprefix"."_category` where `cat_label` = 'uncategorized'";
		$result = $db->query($sql);$row = $result->fetch_assoc(); 
		if(empty($row['cat_id'])){echo 'uncategorized not available';exit;} else {$cat_id = $row['cat_id'];}

		//create cat_post association
		$cat_post_sql = "insert into `$tprefix"."_cat_post` (`cat_id`,`post_id`) VALUES ('".$row['cat_id']."','".$new_post_id."')";echo $cat_post_sql;
		$db->query($cat_post_sql);


		//==========================================

		
		return $new_post_id;
}


//rewrite this function to use url as argument instead of post_id
function fetch_meta_info($path){
		global $db,$tprefix,$tld;
		$sql = "select * from `$tprefix"."_meta` where `path` = '$path'  ";//echo $sql;
		$result = $db->query($sql);
	$row = $result->fetch_assoc();
		if(!empty($row)){
			return $row;	
			}
			else {  
			return FALSE;
		}
	}

//get the content of the post
function get_post_content($id){
	global $tprefix;global $db;
	$sql="select * from `$tprefix"."_content` C inner join `$tprefix"."_meta` M on M.meta_id = C.meta_id where C.id ='$id'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();	
	
	$post['id'] = $row['id'];
	$post['meta_id'] = $row['meta_id'];	
	$post['title'] = $row['title'];
	$post['h1_title'] = $row['h1_title'];
	$post['author'] = $row['author'];
	$post['date_posted'] = $row['date_posted'];
	$post['social_body_text'] = $row['social_body_text'];
	$post['main_text'] = $row['main_text'];
	$post['lang'] = $row['lang']; 
	$post['readmore'] = $row['readmore'];
	$post['published'] = $row['published'];
	$post['note'] = $row['note'];
	
	$post['query_string'] = $row['query_string'];
	$post['path'] = $row['path']; 
	$post['redirect'] = $row['redirect']; 	
	$post['redirect_type'] = $row['redirect_type']; 	
	$post['description'] = $row['description'];
	$post['keyword'] = $row['keyword']; 	
	
	return $post;

}


//get the next new meta_id
function get_new_meta_id(){
	global $db;global $tprefix;
	$sql = "select max(`meta_id`) M from `$tprefix"."_meta`";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $row['M']+1;

}

//get the latest post_id
function get_latest_post_id(){
	global $db;global $tprefix;
		$sql = "select max(`id`) M from `".$tprefix."_content`";//echo $sql;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
		return $row['M']+1;
}

//display the manager version of the current installation
function get_manager_version(){
	$filename = 'version.txt';
	$handle = fopen($filename,'r');
	$content = fread($handle,filesize($filename));
	
	fclose($handle);
	
	return $content;

}