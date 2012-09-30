<?php
include("../class/manager.class.php");
$currentfolder = $_GET["folder"];

$myMan = new Manager();
//read existing images try to scan the directory
try {
	$files = scandir($currentfolder); 
		array_shift($files);array_shift($files);
	//print_r($files);
	} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
	}

//list the images
if(count($files)==0){echo 'empty folder';exit;} else {
	for($i=0;$i<count($files);$i++){
		$size[$i] = getimagesize($imgdir.$files[$i]);
		array_push($size[$i],$files[$i]);
	}
/*
echo '<pre>';print_r($size);echo '</pre>';
*/
//constrain image into a 150*150 max, 
echo '<div id="imagelist">';
	foreach($size as $key => $image){
		$image = $myMan->thumbize($image);
		echo "<div class=\"grab\" ><a href=\"$img$image[4]\">Grab url($image[0]x$image[1])</a></div><img src=\"$tld$imgdir$image[4]\" width=\"$image[5]\" height=\"$image[6]\"  onclick=\"alert('Image name =$image[4]');\" />";
		echo "<br style='clear:both' />";
		}
echo '</div>';