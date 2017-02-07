<?php session_start();
ini_set("include_path", ".:../:./inc:../inc:../../inc");

include("../inc/config.php");
include("inc/php/manager-functions.php");
//manage default values
if(!isset($_GET['cat'])){$cat='all';} else {$cat = $_GET['cat'];}
if(!isset($_GET['id'])){$editid='1';} else {$editid = $_GET['id'];}


if(!isset($_SESSION['LoggedIn'])){
	echo 'u are not logged in please log in';
echo "<meta http-equiv='refresh' content='2;'/manage/index.php' />";

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
<link rel="stylesheet" type="text/css" href="inc/css/manager.css" />
<script type="text/javascript" src="js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="js/script.js"></script>
<link type="text/css" href="js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/js/jquery-ui-1.8.15.custom.min.js"></script>
<script type="text/javascript" src="js/jquery.jeditable.mini.js"></script>
<script src="<?=$tld.$install_folder."/manage/lib/tinymce/js/tinymce/tinymce.min.js"?>"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/prism.js"></script> -->
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.6.0/themes/prism.css" /> -->
<link rel="stylesheet" href="http://localhost/mucms/inc/uikit/css/uikit.min.css" />
<!-- <script src="http://localhost/mucms/inc/uikit/js/uikit.min.js"></script> -->
<!--uikit component-->
<script type="text/javascript" src="inc/js/write.js"></script>
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

<div class="uk-width-1-1">
	

	<div id="header" class="uk-width-1-1">
		<div id="menu">
			<?php
			include("includes/menu.php");
			?>
		</div>
		<br style="clear:both" />
	</div><!-- END OF HEADER DIV  -->

	<div class="uk-grid" id="editor" style="z-index:9;display:block">
		<div class="uk-width-1-1">
				<?php
				include("includes/editor.php");
				?>
		</div>
	</div>


		<div class="uk-grid" id="browser" style="display:none;z-index:10">
		<div class="uk-width-1-1">
				<?php
				include("includes/browser.php");
				?>
		</div>
	</div>

	<div id="footer">
	<?=get_manager_version();?>
	</div>

</div>


</body>
<?php
	}
}//end level
?>

<script>
	var b = document.getElementById('toggler')
	console.log(b)
	b.onclick = function(){
		alert('hello')
	}
</script>
</html>
