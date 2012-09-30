<?php
//check category
//check the checkbox of the category tree
function check_category($post_id,$curr_cat_id){
	global $db,$tprefix;
	$sql = "select count(`cat_id`) AS C from `$tprefix"."_cat_post` where `post_id` = '$post_id' and `cat_id` = '$curr_cat_id'";//echo $sql;
	$result = $db->query($sql);
	if($row = $result->fetch_assoc()){
		$count = $row['C'];
	}
	if($count == 1){
		return 'checked';
	}
	else
	{
	return ;
	}
	
}

function get_category_meta($query_string){
	global $db,$tprefix;
	$sql = "select `meta_id`  from `$tprefix"."_meta` where `type` = 'category' and `query_string` = '$query_string'";//echo $sql;
	
	$result = $db->query($sql);
	if($row = $result->fetch_assoc()){
		$meta_id = $row['meta_id'];
	}
	
	if(!empty($meta_id)){
		return $meta_id;
	}
	else
	{
	return FALSE;
	}	

}

function check_duplicate_category($newcat){
	global $db,$tprefix;
	$sql = "select `cat_label` from `$tprefix"."_category` where `cat_label` = '$newcat'";//echo $sql;
	$result = $db->query($sql);
	if($row = $result->fetch_assoc()){
		$cat_label = $row['cat_label'];
	}

	if(!empty($cat_label)){
		return TRUE;
	
	} else {
	return FALSE;
	}
	
}