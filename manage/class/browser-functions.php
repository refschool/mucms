<?php
/*
AJAX Version of the function that shows the existing categorie
*/
function show_categories() {
	global $db,$tprefix,$tld;
	$catlisting = array();
	
	$sql = "SELECT `cat_label` FROM `$tprefix"."_category`  order by `cat_label` asc";//echo $sql;
	$result = $db->query($sql);

	while($row = $result->fetch_assoc()){
			//store the categorie in an array
			$catlisting[] = $row['cat_label'];
		}
	
	//display the categories in DIV
	?>
	<ul style="list-style-type:none">
		<li><a href="javascript:updatelist('unpub')">Unpublished</a></li>
		<li><a href="javascript:updatelist('all')">ALL</a></li>
		<li><a href="javascript:updatelist('lm10')"> 10 Last Mod</a></li>
		<li><a href="javascript:updatelist('lp10')"> 10 Last Pub.</a></li>
		<li><a href="javascript:updatelist('lp30')"> 30 Last Pub.</a></li>
		<li>------------------</li>
		
		<?php
		for($i=0;$i<count($catlisting);$i++){
			echo "<li><a href=\"javascript:updatelist('$catlisting[$i]')\">$catlisting[$i]</a></li> ";
		}
}
