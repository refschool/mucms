<?php

//function for atom feed header elements

function tagURI($url, $dateposted){
	$tagUri = substr($url,7);
	$st = strpos($tagUri,'/');
	$tagUri = substr_replace($tagUri,','.$dateposted.':',$st,0);
	$tagUri = 'tag:'.$tagUri;
	return $tagUri;
}

//hack for putting time on the date_posted record from the table, but should be deprecated as date_posted is datetime now as of 08/08/10
function UTC($date){
//deprecated
  $date = $date.'T00:00:00Z';
  return $date;
}

function UTCdatetime($datetime){
	$d = date('Y-m-d',strtotime($datetime));
	$t = date('H:m:s',strtotime($datetime));
	return $d.'T'.$t.'Z';
}

function build_rss(){
	global $db,$tprefix,$tld,$authorname,$tUrl;
	$destPath = "../content/feed/";
	$outputFile = "atom.xml";
	$d = date('Y-m-d\TH:i:s\Z');//UTC timestamp at creation date

//atom feed header
$header = '<?xml version="1.0" encoding="UTF-8"?>
<feed xmlns="http://www.w3.org/2005/Atom" >
  <title>'.$tUrl.'</title>
   <link href="'.$tld.'content/feed/atom.xml" rel="self" /> 
   <updated>'.$d.'</updated>
     <author>
    <name>'.$authorname.'</name>
	</author>
  <id>'.$tld.'</id>
  ';

//Atom feed footer
$footer = "</feed>\n";


//get all the active urls
$sql = "SELECT `title`,`author`,`description`,M.path,`date_posted`,`last_edited` FROM `".$tprefix."_content` C INNER JOIN `".$tprefix."_meta` M ON M.meta_id = C.meta_id WHERE `published` = 'Y' ORDER BY `date_posted` DESC";echo $sql;
$result = $db->query($sql);


while($row = $result->fetch_assoc()){
	$title[]=$row["title"]; 
	$author[] = $row["author"]; 
	$description[] = $row["description"];
	$thisurl[] = $row["path"];   
	$lastmodified[] = $row["last_edited"];

	}

//print_r($lastmodified);
//open the file and write the sitemap header then closes it
$handle  = fopen($destPath.$outputFile, 'w');
fwrite($handle,$header);
fclose($handle);

//open in append mode
$handle  = fopen($destPath.$outputFile, 'a');

for($i=0;$i<count($title);$i++){
		fwrite($handle, "<entry>\n");
		fwrite($handle, utf8_encode("\t<title>".$title[$i]."</title>\n"));
			fwrite($handle, "\t<link href=\"".$thisurl[$i]."\"/>\n");
			fwrite($handle, "\t<id>".tagURI($thisurl[$i], $lastmodified[$i])."</id>\n");
			fwrite($handle, "\t<updated>".UTCdatetime($lastmodified[$i])."</updated>\n");
			fwrite($handle, "\t<author>\n");
			fwrite($handle, utf8_encode("\t\t<name>".$author[$i]."</name>\n"));
			fwrite($handle, "\t</author>\n");
			fwrite($handle, utf8_encode("\t<summary>".$description[$i]."</summary>\n"));
		 fwrite($handle,  "\t</entry>\n");
}

fwrite($handle,$footer);
fclose($handle);


}

