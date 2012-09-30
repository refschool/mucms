<?php
//this file saves the config.php file
$filename = $_POST['filename'];
$save = stripslashes($_POST['texte']);
//echo $save;

$handle = fopen($filename, 'w');
//$save = html_entity_decode($save);
fwrite($handle, $save);
fclose($handle);
