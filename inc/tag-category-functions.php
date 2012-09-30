<?php

//get the cateogry id then select the post that belong to that category
function get_category_id($path){
	global $db,$tprefix;
	$sql = "select `cat_id` from `$tprefix"."_category` C INNER JOIN `$tprefix"."_meta` M ON M.meta_id = C.meta_id where `path` = '$path'";//echo $sql;
	$result = $db->query($sql); 
	$row = $result->fetch_assoc();
	
	return $row['cat_id'];
		
}


//get category listing
function get_link_cat($topic){

		global $tprefix; global $tld;global $db;

		
		$sql = "select * from `$tprefix"."_category`  C inner join `$tprefix"."_meta` M on  M.meta_id = C.meta_id where M.type = '$topic'";//echo $sql;

		$result = $db->query($sql); $k=0;
		if($result){
			while($row = $result->fetch_assoc()){
			
				$category[$k]['cat_id'] =  $row['cat_id'];
				$category[$k]['path'] =  $row['path']; 
				$category[$k]['parent_id'] =  $row['parent_id'];
				$category[$k]['cat_label'] =  $row['cat_label'];

				$k++;
				
					}
				}
		
		if(!empty($category)){	
			return $category;
		} else {
			return FALSE;
		}

}


//get the cateogry id then select the post that belong to that category
function get_tag_id($path){
	global $db,$tprefix;
	$sql = "select `tag_id` from `$tprefix"."_tags` T INNER JOIN `$tprefix"."_meta` M ON M.meta_id = T.meta_id where `path` = '$path'";//echo $sql;
	$result = $db->query($sql); 
	$row = $result->fetch_assoc();
	
	return $row['tag_id'];
		
}


//this function retrieves the items from link table
function get_link_tags($topic){

		global $tprefix,$tld,$db;
				
		//read links table and retrieve id, url, alt, anchor
		//put into an array
				$sql = "select * from `$tprefix"."_tags` T inner join `$tprefix"."_meta` M on  M.meta_id = T.meta_id where M.type = 'tag'";//echo $sql;


		$result = $db->query($sql); $k=0;
		if($result){
			while($line = $result->fetch_assoc()){
			
				$linklist[$k]['tag_id'] =  $line['tag_id'];
				$linklist[$k]['path'] =  $line['path'];
				$linklist[$k]['tag_label'] =  $line['tag_label'];

				$k++;
				
								}
				}
		if(!empty($linklist)){	
			return $linklist;
		} else {
			return FALSE;
		}
}