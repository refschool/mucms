<?php

///////////////////main functions//////////////////////


///////////////////auxilliary functions//////////////////////
function check_meta_entry($path){
	global $db,$tprefix;
	$sql = "select `path` from `$tprefix"."_meta` where `path` = '$path'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	if(empty($row)){
	//entry does not exists
		return FALSE;
	
	} else
	{
		//entry already exists
		return TRUE;
	}

}

/**
 * check if a tag is already in the CMS
 * will return an array with tag that are new to the CMS
 * another function will handle the insertion into the database
 * @param  [array]  $tag [description]
 * @return boolean      [description]
 */
function is_in_cms($tags){
	global $db,$tprefix;
	$new_tags = array();

	//loop through the $tag array
	for($i=0;$i<count($tag);$i++){
		$sql = "select `tag_label` `$tprefix"."_meta` where `tag_label` = '".strtolower($tags[$i])."'";
		$result = $db->query($sql);
		//number of rows returned if >0 then the tag is already in the table
		if($result->num_rows == 0){
			//add the tag to the new tag array
			$new_tags[] = strtolower($tags[$i]);
		}
		
	}
	
	return $new_tags;


}


/**
 * add brand new tags to tags table and meta table
 * @param [type] $tags_to_add [description]
 */
function add_cms_tags($tags_to_add){
	global $tprefix,$db,$tld2;
	
	for($i=0;$i<count($tags_to_add);$i++){
	
		$meta_id = get_new_meta_id();
		//insert the meta if only it is not already present
		//// use $db->insert_id??
		
		$entry = $tld2."/tag/".$tags_to_add[$i]."/";
		echo '<br>entry = ' . $entry;
		$entry_exists = check_meta_entry($entry);
		
		if($entry_exists === FALSE){
		$sql1 ="insert into `$tprefix"."_meta` (`meta_id`,`query_string`,`path`,`type`,`meta_canonical`) values ('$meta_id','/tag/".$tags_to_add[$i]."/','".$tld2."/tag/".$tags_to_add[$i]."/','tag','checked') ";//echo '<br>4.0'.$sql1 ;
		$db->query($sql1);
		
		$sql2 = "insert into `$tprefix"."_tags` (`meta_id`,`tag_label`) values ('$meta_id','".$tags_to_add[$i]."')";//echo '<br>4.1'.$sql2 ;
		$db->query($sql2);	
		
		}
	}
}



//add tags to post on the mc_tag_post
function add_tag_post_association($tags_array,$post_id){
	global $tprefix,$db;

	for($i=0;$i<count($tags_array);$i++){
	
		$tag_id = get_tag_id($tags_array[$i]);
	
		$sql = "insert into `$tprefix"."_tag_post` (`tag_id`,`post_id`) values ('".$tag_id."','$post_id')";
		//echo '<br>XXZEN'.$sql ;
		$db->query($sql);

	}
}

//remove tags to post on the mc_tag_post
/**
 * [remove_tag_post_association description]
 * @param  [type] $tags_to_remove [description]
 * @param  [type] $post_id        [description]
 * @return [type]                 [description]
 */
function remove_tag_post_association($post_id){
	global $tprefix,$db;
	
	$sql = "delete from `$tprefix"."_tag_post` where `post_id` = '".$post_id."'";
	echo '<br>1' .$sql;
	$db->query($sql);

	
}



//get meta_id of tag*************************
function get_tag_meta_id($tag_label){
	global $tprefix;global $db;
	$sql = "select `meta_id` from `$tprefix"."_meta` where `tag_label` = '".$tag_label."'";//echo '<br>2' .$sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $row['tag_id'];


}


//get the tag_ig from tag_label
function get_tag_id($tag_label){
	global $tprefix;global $db;
	$sql = "select `tag_id` from `$tprefix"."_tags` where `tag_label` = '".$tag_label."'";//echo '<br>2' .$sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $row['tag_id'];
}



//build a string of tags to display in the manager
function get_tags_as_string($post_id){
	$tags = get_post_tags($post_id);//select the tags for a given post
	$s = '';
	//concatenate the tags
	for($i=0;$i<count($tags);$i++){
		$s = $s . ',' . $tags[$i];
	}	
	
	if(!empty($s)){
		return substr($s,1);
	} else {
		return FALSE;
	}
}


//get tags for a post
//used to display on editor but also in the tag insertion function
function get_post_tags($post_id){
	global $tprefix,$db;
	$tags = array();
	
	$sql = "select T.tag_label,TP.tag_id from `$tprefix"."_tag_post` TP INNER JOIN `$tprefix"."_tags` T ON T.tag_id = TP.tag_id where TP.post_id = '$post_id'";//echo 'get_post_tags sql = ' .  $sql;
	
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()){
		$tags[] = $row['tag_label'];
		
	}	

	return $tags;
	
	//do not use the syntax below because we need to return an empty array  and not a FALSE boolean
/*	if(!empty($tags)){
		return $tags;
	} else {
		return FALSE;
	}
*/
}




//remove a tag from the active tags 
//remove from mc_tags
//remove from mc_meta

/*
//get active tags of the cms
//these are the tags that are in the tag table, 
function get_active_tags(){
	global $tprefix;global $db;
		$sql = "select distinct `tag_label` from `$tprefix"."_tags` T INNER JOIN `$tprefix"."_tag_post` TP ON TP.tag_id = T.tag_id";//echo $sql;
		$result = $db->query($sql);
		while($row = $result->fetch_assoc()){
			$active_tags[] = $row['tag_label'];//list active tags cms level, tags that is attached to a post
		
	}	
	if(!empty($active_tags)){
		return $active_tags;
	} else {
		return FALSE;
	}
}

//get tags existing in the mc_tags table
function get_existing_tags(){
	global $tprefix;global $db;
		$sql = "select distinct `tag_label` from `$tprefix"."_tags` ";//echo $sql;
		$result = $db->query($sql);
		while($row = $result->fetch_assoc()){
			$active_tags[] = $row['tag_label'];//list active tags cms level, tags that is attached to a post
		
	}	
	
	if(!empty($active_tags)){
		return $active_tags;
	} else {
		return FALSE;
	}
}

*/

/*
//get tags from tags table
//where is it used??
function get_tags(){
	global $tprefix,$db;
	
	$tags = array();
	
	$sql = "select `tag_label` from `$tprefix"."_tags`";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()){
		$tags[] = $row['tag_label'];
		
	}	
	return $tags;
}
*/




//
/**
 * remove cms tag from tags and meta table
 * DO NOT USE THIS FUNCTION
 * @param  [type] $tags_to_remove [description]
 * @return [type]                 [description]
 */
/*
function remove_cms_tags($tags_to_remove){
	global $tprefix,$db,$tld2;
	
	for($i=0;$i<count($tags_to_remove);$i++){
	$tag_id = get_tag_id($tags_to_remove[$i]);
	$path = $tld2  . '/tag/' . $tags_to_remove[$i] . '/';
	
	$sql = "delete from `$tprefix"."_tags` where `tag_id` = '$tag_id'";//echo '<br>5'.$sql ;
	$db->query($sql);	
	
	$sql2 = "delete from `$tprefix"."_meta` where `path` = '$path'";//echo '<br>6'.$sql2 ;
	$db->query($sql2);
	}
}
*/