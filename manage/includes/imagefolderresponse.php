<?php
//this file ouputs th thumbs
ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("config.php");
include("../class/manager.class.php");

$myMan = new Manager();
$currentfolder = $_GET["folder"];
$root = "$tld"."content/images";

	$files = scandir("../../content/images/" . $currentfolder); 		
	array_shift($files);array_shift($files);//skip . and ..
	
		$parent = $currentfolder;

function isfile($f){

	$r = preg_match('/.jpg/',$f);//match the jpeg files
	if($r>0){ return $f;} else {return ;}
}
	
echo "<p>Current Upload Image Folder:<span id=\"foldername\">$parent</span></p>";

echo '<ul>';
//the line below is pure chance !
echo "<li><a href=\"javascript:listimagefolder('$folder/')\" />Back</a></li>";
	foreach($files as $folder){
		echo "<li><a href=\"javascript:listimagefolder('$parent$folder/')\" />$folder</a></li>";
}
echo '</ul>';

foreach($files as $handle){
	//process only files not directory
	if(isfile($handle)){
		$image = $myMan->thumbize($handle);
		echo "<div class=\"grab\" ><a href=\"$img$image[4]\">Grab url($image[0]x$image[1])</a></div><img src=\"$tld$imgdir$image[4]\" width=\"$image[5]\" height=\"$image[6]\"  onclick=\"alert('Image name =$image[4]');\" />";
		echo "<br style='clear:both' />";
	}
	else
	{}

}

?>