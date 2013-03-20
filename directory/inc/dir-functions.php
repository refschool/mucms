<?php


function get_short_desc_mini(){
	global $short_desc_mini_char,$short_desc_mini_word;
	if(!empty($short_desc_mini_char)){
		return $short_desc_mini_char . ' caractères';
	} else {
		return $short_desc_mini_word . ' mots';

	} 

}



function get_long_desc_mini(){
	global $long_desc_mini_char,$long_desc_mini_word;
	if(!empty($long_desc_mini_char)){
		return $long_desc_mini_char . ' caractères';
	} else {
		return $long_desc_mini_word . ' mots';

	} 

}