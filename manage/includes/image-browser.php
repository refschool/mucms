<script type="text/css">
.grab {width:160px;background-color:transparent;}
.thumb {width:160px; height:auto;background-color:#ccc;}
</script>

<?php
//variables imgdir is the relative path to the current image folder
$imgdir = '../content/images/' . $myMan->getCurrentImageSubDir();
//echo $imgdir;


//read existing images try to scan the directory

	$files = scandir($imgdir); //Returns an array of files and directories from the directory. 
	echo '<pre>';
	print_r($files);
	echo '<pre>';
	
//list the images
if(count($files)< 3){echo 'nothing to display here.'; exit;} else {
	foreach($files as $file){

		echo '<a href="'.$imgdir.$file.'">' . $file . '</a><br />';
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
}
/* $size array structure
        (
            [0] => 300
            [1] => 250
            [2] => 1
            [3] => width="300" height="250"
            [bits] => 8
            [channels] => 3
            [mime] => image/gif
            [4] => avertisseur-radar-coyote_300x250.gif
        )

*/