<?php 
$editid = $_GET['id'];//if(!isset($editid)){$editid = 1;}

$post = get_post_content($editid);

$meta_array = fetch_meta_info($path);//print_r($meta_array);
$topic = $_GET['topic'];
?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Edit config.php</a></li>
		<li><a href="#tabs-2">Plugins-config.php</a></li>
		<li><a href="#tabs-3">Nav settings</a></li>	
		<li><a href="#tabs-4">Category</a></li>	
	</ul>
	
	
<form action="settings-update.php" method="post" >		
	<div id="tabs-1">
		<p>Edit config.php</p>
		<textarea id="config" name="config" rows="45" cols="70"><?php 
		$file = '../../inc/config.php';
		$handle = fopen($file,'r');
		$buffer = fread($handle, filesize($file)) ;
		fclose($handle);	
		echo $buffer;
	?></textarea>
		

	</div>		

	<div id="tabs-2">
		<p>Edit plugins-config.php</p>
		<textarea id="config" name="plugins" rows="45" cols="70"><?php 
		$file = '../../content/plugins/plugin-config.php';
		$handle = fopen($file,'r');
		$buffer = fread($handle, filesize($file)) ;
		fclose($handle);	
		echo $buffer;
	?></textarea>			
	</div>

	
	<div id="tabs-3">
		<p>Select menu type</p>
		<input type="radio" name="menu_type" value="" checked />Dynamic<br>
		<input type="radio" name="menu_type" value="" />Static<br>

		<p>Select Footer type</p>
		<input type="radio" name="footer_type" value="" checked />Dynamic<br>
		<input type="radio" name="footer_type" value="" />Static<br>
		
			
	</div>
	<input type="submit" Value="Update" >
</form>	
	
	<div id="tabs-4">
		<p>Create category</p>
		<form method="post" action ="create-category.php" >
		<input type="text" name="newcat" value="" />
		<input type="submit" Value="Create" >
		</form>
	</div>
	



</div>
