<?php
//use this file to include addon for adding new functionnality or override existing one
//GA code
//include("ga/ga.php");
//$hook['after_body'][10] = 'ga';

//crawltrack code
//include("crawltrack.php");
//$hook['before_head'][10] = 'get_crawltrack';


//custom menu
include("custom-menu.php");
$hook['menu'][10] = 'get_custom_menu' ;

//custom footer
include("custom-footer.php");
$hook['footer'][10] = 'get_custom_footer' ;

//dummy test
//include("dummy.php");

//hook_add('sidebar_tag','dummy',11);

//hook_remove('sidebar');

//custom hook

//echo '<pre>';print_r($hook);echo '</pre>';

//allows sorting plugins priority
deep_ksort($hook);