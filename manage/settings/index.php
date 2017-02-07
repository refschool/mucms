<?php session_start();
//index of settings
ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("../../inc/config.php");
include("../inc/php/manager.class.php");
include("../inc/php/manager-functions.php");
$cat = $_GET['cat'];$editid = $_GET['id'];$tab_id = $_GET['tab_id'];


if(!isset($_SESSION['Userlevel'])){
	echo 'u are not logged in please log in';
echo "<meta http-equiv='refresh' content='2;$tld"."manage/index.php' />";

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
<title>Site settings</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/manager.css" />
<script type="text/javascript" src="../js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
		<link type="text/css" href="../js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../js/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/js/jquery-ui-1.8.15.custom.min.js"></script>
		<script type="text/javascript" src="../js/jquery.jeditable.mini.js"></script>
<script type="text/javascript">
//Jeditable
$(document).ready(function() {
     $('.edit').editable('<?=$tld.'manage/settings/savedb.php'?>');
 });
 
 
	$(function() {
		$("#tabs").tabs();
	});
	
	$(function() {
		$("#btabs").tabs();
	});

	$(function(){
	$('#link_table_menu').click(function(){
		$.post('links.php',{topic:"menu"},function(data){$('#links').html(data)})
	
		});
	
	});

	
	$(function() {
	
		$("#addlink").click(function() {
		
		$("#links > tbody:last").append('<tr><td class="data" id="lid"></td><td class="data edit"></td><td class="data edit"></td><td class="data edit"  ></td><td class="data edit" ></td><td class="data edit" ></td><td class="data edit" ></td><td>Delete</td></tr>').bind('click',function(){
			$('.edit').editable('<?=$tld.'manage/settings/savedb.php'?>');
		});
		
		
		//after row is created populate with id indexation important for correct sql insertion
		//we used lid as a workaround to traverse the table
		//we use call back function to pass the id number sebt back by AJAX and append it to every id
		$.post('controller.php',{action:"add"},function(data){$("#lid").html(data.link_id);$("#lid").next().attr('id','postd_' +data.link_id).next().attr('id','topic_' + data.link_id ).next().attr('id','urloc_' + data.link_id).next().attr('id','alter_' + data.link_id).next().attr('id','ancho_' + data.link_id).next().attr('id','misce_' + data.link_id).next().attr('id','delete' + data.link_id);
		//remove attribute #lid we don't need it no more
		$("#lid").removeAttr("id");
		},"json");
	
		})
	});
	
	$(function() {
		$('table td#delete').click(function(){
			var x = $(this).prev().attr('id'); 
			$.post('controller.php',{action : "delete", id : x})
			$(this).parent().remove();
		})
		
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
			include("settings-editor.php");
			?>

		</div><!-- END OF EDITOR DIV -->

		<div id="browser" style="width:49%">
			<?php
			include("settings-browser.php");
			?>
		</div><!-- END OF BROWSER DIV -->

	</div>
</div>
</body>
<?php

}

}//end level


?>



</html>