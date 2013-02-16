<?php

function dummy(){

	$current_url = $_SERVER['SCRIPT_URI'];


	foreach($url_array AS $url){
		if($url == $current_url){
			echoit( 'GOOD DUMMY');
		}
		else 
		{
			echoit('mauvais DUMMY');
		}
	
	}

	

}