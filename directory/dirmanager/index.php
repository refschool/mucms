<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc");

include("../../inc/config.php");include("../../manage/class/manager-functions.php");
include('../inc/dir-functions.php');
include('../inc/dir-bo-functions.php');

if(isset($_SESSION['Userlevel']) &&  $_SESSION['Userlevel'] <> 'admin'){
echo 'user level = '. $_SESSION['Userlevel'];
	echo "Vous n'avez pas les droits suffisants pour éditer !<br> ";
	echo '<a href="'.$tld.'">Retour</a><br>';
	echo '<a href="'.$tld.'manage/logout.php">Logout</a>';
}

if(!isset($_SESSION['LoggedIn'])){
	echo 'u are not logged in please log in';
	$_SESSION['returnPath'] = $tld2 . '/directory/dirmanager/index.php';

	echo "<meta http-equiv='refresh' content='1;$tld2"."/manage/index.php' />";

}
	
	

else {
$entry = get_dir_entries();
$cat = get_categories();


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Directory Management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="../../manage/css/manager.css" />
<script type="text/javascript" src="js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="js/script.js"></script>
		<link type="text/css" href="js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="js/js/jquery-ui-1.8.15.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
<script type="text/javascript" src="js/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
<script type="text/javascript" >
tinyMCE.init({
        mode : "textareas",
		editor_selector :"mceEditor",
		/*entity_encoding : "raw",*/
		convert_urls : false,
        theme : "advanced",   //(n.b. no trailing comma, this will be critical as you experiment later)
		plugins:"wordcount,table,fullscreen",
		theme_advanced_buttons3_add : "fullscreen,tablecontrols,fontsizeselect",
		theme_advanced_toolbar_location : "top",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_toolbar_align : "left"
		
});
</script>		
</head>
<body>
	<div id="frame">
<!--directory management interface-->
<!--list the entries-->
	<div id="header">
		<div id="menu">
			<?php
			include("../inc/menu.php");
			?>
		
		</div>
	</div>

	<div id="main">		
		<table class="collapse">
			<tr class="header">
				<th>Entry Id</th>
				<th>Meta Id</th>
				<th>cat Id</th>
				<th>Website Name</th>
				<th>Url</th>
				<th>Email</th>
				<th>Datetime</th>
				<th>Action</th>
			</tr>
			<?php
			for($i=0;$i<count($entry);$i++){

			?>
			<tr>
				<td><?=$entry[$i]['entry_id']?></td>
				<td><a href="<?=$entry[$i]['path']?>" title="<?=$entry[$i]['path']?>" ><?=$entry[$i]['meta_id']?></a></td>
				<td><?=$entry[$i]['cat_id']?></td>
				<td><?=$entry[$i]['website_name']?></td>
				<td><?=$entry[$i]['website_url']?></td>
				<td><?=$entry[$i]['email']?></td>
				<td><?=$entry[$i]['datetime']?></td>
					<td><a href="dir-edit.php?entryid=<?=$entry[$i]['entry_id']?>">Edit</a></td>

			</tr>

			<?php
			}
			?>

		</table>

</div>

</div><!--frame-->


	<div id="footer">
	<?=get_directory_version();?>
	</div>
</body>

<?php

}


?>



</html>