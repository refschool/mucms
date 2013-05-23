<?php
function get_post_note($post_id){
		global $db,$tprefix,$tld;
		$sql = "select `note` from `$tprefix"."_content` where `id` = '$post_id'  ";//echo $sql;
		$result = $db->query($sql);
		$row = $result->fetch_assoc();
	
		if(!empty($row)){
			return $row['note'];	
			}
			else {  
			return FALSE;
		}


}