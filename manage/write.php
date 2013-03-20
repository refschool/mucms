<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc");

include("../inc/config.php");include("class/manager-functions.php");

include("class/manager.class.php");
//manage default values
if(!isset($_GET['cat'])){$cat='all';} else {$cat = $_GET['cat'];}
if(!isset($_GET['id'])){$editid='1';} else {$editid = $_GET['id'];}


if(!isset($_SESSION['LoggedIn'])){
	echo 'u are not logged in please log in';
echo "<meta http-equiv='refresh' content='2;$tld2".$install_folder."/manage/index.php' />";

}
	
	
if(isset($_SESSION['Userlevel']) &&  $_SESSION['Userlevel'] <> 'admin'){
echo 'user level = '. $_SESSION['Userlevel'];
	echo "Vous n'avez pas les droits suffisants pour éditer !<br> ";
	echo '<a href="'.$tld.'">Retour</a><br>';
	echo '<a href="'.$tld.'manage/logout.php">Logout</a>';
}

else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Article management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="css/manager.css" />
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
</script >		
<script type="text/javascript">
//jeditable
$(document).ready(function() {
     $('.edit').editable('<?=$tld.'manage/includes/save.php'?>');
 });

 $(function() {
	$('table td#delete').click(function(){
		var x=$(this).prev().attr('id');alert(x);
		
		$.post('controller.php',{action:"delete",id:x});
		$(this).parent().remove();
	
	});
 
 });
 
 
 $(function() {
	$('#rel_add').click(function(){
	//dynamically add the row and send data to remote function
		$('#rel_links > tbody:last').append('<tr class="data edit"><td class="data edit" id="postd_"><td class="data edit" id="ancho_"></td><td class="data edit" id="urloc_"></td><td class="data" id="delete"><a href="#">Delete</a></td></tr>').bind('click',function(){$('.edit').editable('<?=$tld.'manage/settings/savedb.php'?>')});
		
		//dynamically populate the row with callback function
		$.post('controller.php',{action:"add"},function(data){$("#postd_").html(<?=$editid ?>).attr("id", "postd_" + data.link_id).next().attr("id","ancho_"+data.link_id).next().attr("id","urloc_"+data.link_id)},"json");

		
		
	});
 
 });

 
	$(function() {
		$("#tabs").tabs();
	});
	
	$(function() {
		$("#btabs").tabs();
	});
	
	$(function() {
		$("#category").click(function(){
			
		
		});
	});
	
	//ajax update of the textarea
	$(function() {
		$('#ajaxUpdate').click(function(){
			var txt = $('#main_text').val();
			
			$.post('do.php',{postid: "<?=$editid ?>" , main_text : txt });//alert('<?=$editid ?>'+' édité : ' + txt);
		});
	
	
	});
	
	
	</script>

</head>
<?php
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
	{
?>
<body onload="updatelist('<?php if(empty($_SESSION['category'])){echo 'all'; } else{echo $_SESSION['category'];} ?>');">

<div id="frame">
	<div id="header">
		<div class="message">
			<?php 
			$myMan = new Manager();
			//$myMan->showVersionMessage();
			?>
		</div>
		
		<div id="menu">
			<?php
			include("includes/menu.php");
			?>
		
		</div>
		<br style="clear:both" />
	</div><!-- END OF HEADER DIV  -->

	<div id="main">		

		<div id="editor" style="width:50%">
			<?php
			include("includes/editor.php");
			?>

		</div><!-- END OF EDITOR DIV -->

		<div id="browser" style="width:49%">
			<?php
			include("includes/browser.php");
			?>
		</div><!-- END OF BROWSER DIV -->

	</div>
</div>
<br style="clear:both" />
<div id="footer">
<?=get_manager_version();?>
</div>

</body>
<?php

}

}//end level


?>



</html>