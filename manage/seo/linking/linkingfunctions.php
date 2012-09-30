<?php
ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
include("config.php");include("class/manager.class.php");

//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
	

//fetch get urls from tables : links, content to compute
function get_urls(){
	global $db;global $tprefix;global $tld;


		//query all the urls of table content
		$sql  = "select * from `$tprefix"."_content` where `published` = 'Y'";
		$result = $db->query($sql); 
		if($result){
			while($row = $result->fetch_assoc()){
				$urls[] = $row['thisurl'];
			}
		}		
		
		//query all urls from table links
		$sql2 = "select * from `$tprefix"."_links` where `topic` IN ('category','tag')";echo $sql2;
		$result2 = $db->query($sql2); 
		if($result2){
			while($row2 = $result2->fetch_assoc()){
				$urls2[] = $row2['url'];
			}
		}
		//add tld at top of array
		array_unshift($urls,$tld);
		$urls = array_merge($urls,$urls2);
	
	return $urls;
}
