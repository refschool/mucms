<?php
//use this file to include addon for adding new functionnality or override existing one



//custom menu
include("custom-menu.php");
$hook['menu'][10] = 'get_custom_menu' ;

//custom footer
include("custom-footer.php");
//$hook['footer'][10] = 'get_custom_footer' ;



//custom hook
//$hook['sidebar_tag'][100] = 'remove_hook';
//echo '<pre>';print_r($hook);echo '</pre>';


//$hook['meta_title'][0] = 'get_directory_title';
/*
//custom functions
function get_directory_title(){
	echo 'title from directory';
}
*/
