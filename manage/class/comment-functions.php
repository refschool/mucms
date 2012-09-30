<?php

//get the number of comments
function get_comment_nb($post_id){
	global $tprefix; global $tld;global $db;
	
	$sql = "select count(*) C from `$tprefix"."_comments` where `post_id` = '$post_id' and `status` = 'P' ";
	//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $nb = $row['C'];

}


//
function get_comments($post_id){
		global $db,$tprefix,$tld;
	$sql = "select * from `$tprefix"."_comments` where `post_id` = '$post_id';";//echo $sql;
	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$comments[$k]['comment_id'] = $row['comment_id'];
		$comments[$k]['name'] = $row['name'];
		$comments[$k]['email'] = $row['email'];
		$comments[$k]['website'] = $row['website'];
		$comments[$k]['comment'] = $row['comment'];		
		$comments[$k]['status'] = $row['status'];
		$comments[$k]['timestamp'] = $row['timestamp'];		
	$k++;
	}

	if(!empty($comments)){
		return $comments;
	}
	else {
		return FALSE;
	
	}
}