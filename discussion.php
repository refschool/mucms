<?php
$PATH = 'content/';

include($PATH."mu_init.php");

include($PATH."mu_surround.php");

include($PATH.'mu_header.php');

//preparing main content
	$data= $cr->showPosts($db,0,5,'');
	
//====HOOK07===
$if["HOOK07"] = 'GAoutbound.php';
include($PATH."plugins/".$if["HOOK07"]);
//=============

include($PATH.'mu_footer.php');

//finally renders the page
$smarty->display('content.tpl');
?>