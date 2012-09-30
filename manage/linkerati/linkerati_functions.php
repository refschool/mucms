<?php

//get linkerati for a linkerati_id
function get_single_linkerati($link_id){
	global $db;global $tprefix;

		$sql = "select * from `$tprefix"."_linkerati` where `linkerati_id` = '$link_id'";//echo $sql;
		$result = $db->query($sql);
		if($row = $result->fetch_assoc()){
			$linkerati['linkerati_id'] = $row['linkerati_id'];
			$linkerati['external_url'] = $row['external_url'];
			$linkerati['rel'] = $row['rel'];
			$linkerati['pagerank'] = $row['pagerank'];
			$linkerati['link_type'] = $row['link_type'];
			$linkerati['date'] = $row['date'];
		
		
		}

	return $linkerati;

}


//get database of identified links
function get_linkerati(){
	global $db;global $tprefix;

		$sql = "select * from `$tprefix"."_linkerati`";//echo $sql;
		$result = $db->query($sql);$k=0;
		if($result){
		
		while($row = $result->fetch_assoc()){
			$linkerati[$k]['linkerati_id'] = $row['linkerati_id'];
			$linkerati[$k]['external_url'] = $row['external_url'];
			$linkerati[$k]['rel'] = $row['rel'];
			$linkerati[$k]['pagerank'] = $row['pagerank'];
			$linkerati[$k]['link_type'] = $row['link_type'];
			$linkerati[$k]['date'] = $row['date'];
			$k++;
		}

	return $linkerati;
	}
}


function get_linkbuilding(){
	global $db;global $tprefix;

		$sql = "select * from `$tprefix"."_linkbuilding`";//echo $sql;
		$result = $db->query($sql);$k=0;
		if($result){
			while($row = $result->fetch_assoc()){
				$linkbuilding[$k]['inlink_id'] = $row['inlink_id'];
				$linkbuilding[$k]['page_id'] = $row['page_id'];
				$linkbuilding[$k]['source_url_id'] = $row['source_url_id'];
				$linkbuilding[$k]['source_url'] = $row['source_url'];
				$linkbuilding[$k]['anchor'] = $row['anchor'];
				$linkbuilding[$k]['rel'] = $row['rel'];
				$linkbuilding[$k]['pagerank'] = $row['pagerank'];			
				$linkbuilding[$k]['link_type'] = $row['link_type'];
				$linkbuilding[$k]['date'] = $row['date'];			
				$linkbuilding[$k]['misc'] = $row['misc'];			
				$k++;
			}

	return $linkbuilding;
	}
}