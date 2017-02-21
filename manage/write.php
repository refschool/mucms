<?php session_start();
ini_set("include_path", ".:../:./inc:../inc:../../inc");

include("../inc/config.php");
include("inc/php/manager-functions.php");
//manage default values
if(!isset($_GET['cat'])){$cat='all';} else {$cat = $_GET['cat'];}
if(!isset($_GET['id'])){$editid='1';} else {$editid = $_GET['id'];}


if(!isset($_SESSION['LoggedIn'])){
	echo 'u are not logged in please log in';
echo "<meta http-equiv='refresh' content='2;".$base_url."/manage/index.php' />";

}
	
if(isset($_SESSION['Userlevel']) &&  $_SESSION['Userlevel'] <> 'admin'){
echo 'user level = '. $_SESSION['Userlevel'];
	echo "Vous n'avez pas les droits suffisants pour éditer !<br> ";
	echo '<a href="'.$tld.'">Retour</a><br>';
	echo '<a href="<?=$base_url?>/manage/logout.php">Logout</a>';
}

else {

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Article management</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="inc/css/manager.css" />
<script type="text/javascript" src="<?=$base_url?>/manage/inc/js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="<?=$base_url?>/manage/inc/js/script.js"></script>
<link type="text/css" href="js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
<script type="text/javascript" src="js/js/jquery-1.6.2.min.js"></script>
<script type="text/javascript" src="js/js/jquery-ui-1.8.15.custom.min.js"></script>
<script src="<?=$base_url."/manage/lib/tinymce/js/tinymce/tinymce.min.js"?>"></script>
<link rel="stylesheet" href="<?=$base_url."/inc/uikit/css/uikit.min.css" ?>"/>
<script type="text/javascript"  src="<?=$base_url."/inc/uikit/js/uikit.min.js" ?>"></script>
<script type="text/javascript" src="<?=$base_url."/manage/inc/js/write.js"?>"></script>
<script type="text/javascript">
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
	</script>
</head>
<?php
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
	{
?>
<body onload="updatelist('<?php if(empty($_SESSION['category'])){echo 'all'; } else{echo $_SESSION['category'];} ?>');">

	<div id="header" class="uk-width-1-1">
		<div id="menu">
			<?php
			include("includes/menu.php");
			?>
		</div>
		<br style="clear:both" />
	</div><!-- END OF HEADER DIV  -->


		<!-- test DIV  -->
	<div class="uk-grid" >
		<div class="uk-width-3-4">
			<div class="uk-card uk-card-default uk-card-body">

			<div id="editor" style="z-index:9;display:block" class="uk-grid">
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

			</div>

		</div>


		<div class="uk-width-1-4">
			<div class="uk-card uk-card-default uk-card-body">sidebar</div>
				

			<div class="uk-card uk-card-default uk-card-body">sidebar</div>
		</div>
	</div>



		<div>

			<div id="footer">
				<?=get_manager_version();?>
			</div>
		</div>

	</div>

</body>
<?php
	}
}//end level
?>

<script>
	const b = document.getElementById('toggler')
	const c = document.getElementById('close_browser')

	b.onclick = function(){
		document.getElementById('editor').style.display = "none";
		document.getElementById('browser').style.display = "block";
	}

	c.onclick = function(){
		document.getElementById('editor').style.display = "block";
		document.getElementById('browser').style.display = "none";
	}
</script>
</html>
