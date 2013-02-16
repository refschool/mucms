<?php
//@HOOK07 @P=1

Class Outbound {
function insert_track_code($post){

	$js = " onclick=\"javascript: pageTracker._trackPageview('/outgoing/');\">";
	
	preg_match_all('/<a href="[^>]+>/i',$post,$matches);
	//we only want the matches
	$oldtags = $matches[0];
	//since we track only outbound clicks , let's eliminate the inbound urls

	$oldtags = array_filter($oldtags, "Tracker::discard_inboundurls");
	
	//echo 'oldtags array'.'<br />';
	//print_r($oldtags);
	
	//copy to a new array
	foreach($oldtags as $key => $value){
	$n[] = $value;
	}
	//print_r($n);
	//insert at given position : onClick="javascript: pageTracker._trackPageview('/outgoing/');"
	for($i=0;$i<count($oldtags);$i++){ $newtags[$i] = str_replace('>',$js,$n[$i]);}
	
	//print_r($newtags);
	
	//now replace the original text with new tags
	$newstring = str_replace( $oldtags,$newtags,$post);
	return $newstring;
	
		}
}

$t = new Outbound();
$main_text = $t->insert_track_code($main_text);