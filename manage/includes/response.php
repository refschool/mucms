<?php 
include("../../inc/config.php");
$postid = $_GET["postid"];;
$content = '';
/*
xhr.onreadystatechange :
    * 0 non initialis�e
    * 1 en chargement
    * 2 charg�e
    * 3 en cours de traitement
    * 4 termin�e

*/
/*header('Content-Type: text/xml'); 
echo "<?xml version=\"1.0\"?>\n";
echo "<example>\n";
*/

$sql = "select * from $tprefix"."_content where `id` = $postid";
//echo $sql;
$result = $db->query($sql);

if($row = $result->fetch_assoc()){
	$content = $row["main_text"];
}

echo "$content\n";

?>