<?php
include("../../inc/config.php");


$parent_id = $_GET['parent_id'];//pretty($category);
$parent_name = $_GET['parent_name'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Create Category | <?=$site_title?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="description" content="Mucrm" />
<meta name="keywords" content = "CRM" />
<link rel="stylesheet" type="text/css" href="inc/css/admin.css" />
<link rel="stylesheet" type="text/css" href="inc/css/blitzer/jquery-ui-1.8.5.custom.css" />
<link rel="stylesheet" type="text/css" href="inc/css/datatables/demo_table_jui.css" />
<link rel="stylesheet" type="text/css" href="inc/css/datatables/demo_table.css" />
<script type="text/javascript" src="inc/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="inc/js/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="inc/js/script.js"></script>
<link href='http://fonts.googleapis.com/css?family=Rokkitt:700' rel='stylesheet' type='text/css'>
</head>

<body>
	<div id="superframe">

		<div id="frame">
		<div id="data" style="margin-left:20px;float:none">	
			<form method="post" action="category-insert.php">
			<h2>Parent Name : <?=$parent_name?></h2>
			
			
			
				<p>Category name</p>
				<p><input type="text" name="category_name" value=""></p>
				<p>Parent ID<p>
				<p><input type="text" name="parent_id" value="<?=$_GET['parent_id'];?>"></p>
				
				<br><input type="submit" value="Soumettre">
			</form>
		</div><!--end data-->
	</div><!--end frame-->
</div><!--end superframe-->
</body>
</html>