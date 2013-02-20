<?php session_start();
include("../../inc/config.php");
include("../class/manager.class.php");
include("seofunctions.php");
include("pr.class.php");


	if($_SESSION['Userlevel'] <> 'admin'){
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
<title>Search Engine Optimisation</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="../css/manager.css" />
<script type="text/javascript" src="../js/ajax.js"></script>
<script language="javascript" type="text/javascript" src="../js/script.js"></script>
		<link type="text/css" href="../js/css/ui-lightness/jquery-ui-1.8.15.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="../js/js/jquery-1.6.2.min.js"></script>
		<script type="text/javascript" src="../js/js/jquery-ui-1.8.15.custom.min.js"></script>
		<script type="text/javascript" src="../js/jquery.jeditable.mini.js"></script>
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
<body onload="updatelist('<?php $_SESSION['category'] = '' ? 'all' : $_SESSION['category'] ; echo $_SESSION['category']; ?>');">

<div id="frame">
	<div id="header">
		<div class="message">
			<?php 
			//$myMan = new Manager();
			
			?>
		</div>
		
		<div id="menu">
			<?php
			include("../includes/menu.php");
			?>
		
		</div>
		<br style="clear:both" />
	</div><!-- END OF HEADER DIV  -->

	<div id="main">		

		<div id="editor" style="width:75%">
			<?php
			include("seoeditor.php");
			?>

		</div><!-- END OF EDITOR DIV -->

		<div id="browser" style="width:20%">
			<?php
			include("seobrowser.php");
			?>
		</div><!-- END OF BROWSER DIV -->

	</div>
</div>
</body>
<?php

}
else {

//not logged in
echo 'u are not logged in please log in';
echo "<meta http-equiv='refresh' content='1;$tld"."manage/index.php' />";

	}

}//end level
?>



</html>