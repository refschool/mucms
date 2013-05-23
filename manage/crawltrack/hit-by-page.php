<?php session_start();
include("../../inc/config.php");
include("../class/manager-functions.php");
//include("crawltrack-functions.php");


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
		$( "#start" ).datepicker({ dateFormat: 'yy-mm-dd' });
		$( "#end" ).datepicker({ dateFormat: 'yy-mm-dd' });
		});	
	</script>
</head>
<?php
	if(!empty($_SESSION['LoggedIn']) && !empty($_SESSION['Username']))
	{
?>
<body>

<div id="frame">
	<div id="header">
		<div class="message">
			<?php 
			
			
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

			
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Trafic to Landing Page Overview</a></li>
		</ul>
	
	<div id="tabs-1">


		<?php
				if($_POST['end'] == ''){
					$_POST['end'] = date('Y-m-d');
				} 
				
				if($_POST['start'] == ''){
					$_POST['start'] = date('Y-m-d',strtotime('- 1 month')) ;
				} 
		?>
			<form action="<?=$_SERVER['PHP_SELF'];?>?id_page=<?=$_GET['id_page']?>" method="post" >
					<table>
					<tr>
						<td>
							<label>Start</label><br>
							<input type="text" id="start" name="start" size="10" value="<?=$_POST['start']?>" />
						</td>
						<td>
							<label>End</label><br>
							<input type="text" id="end" name="end" size="10" value="<?=$_POST['end']?>" />
						</td>
					
					
						<td><input type="submit" value="submit" /></td>
					</tr>

				</table>
			</form>
		<?php

//afficher toutes les pages

$traffic_sitewide = get_pages_traffic_sitewide($_POST['start'],$_POST['end']);

echo '<table class="collapse"><tr><th>Hits</th><th>URL</th></tr>';
for($i=0;$i<count($traffic_sitewide);$i++){

?>
<tr>
	
	<td><?=$traffic_sitewide[$i]['count']?></td>
	<td><?=$traffic_sitewide[$i]['url_page']?><a href="hit-by-page-evolution.php?id_page=<?=$traffic_sitewide[$i]['id_page']?>" > [View Evolution Over Time]</a></td>

</tr>

<?php
}

	?>
</table>
		<br style="clear:both" />
	</div>








		</div><!-- END OF EDITOR DIV -->

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