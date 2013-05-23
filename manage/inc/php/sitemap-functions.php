<?php
function build_sitemap(){
	global $db,$tld,$tprefix;
	$destPath = "../content/sitemap/";
	$outputFile = "sitemap.xml";
	$url = array();
	$lastmodified = array();


	$header = '<?xml version="1.0" encoding="UTF-8"?>
	<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
	$footer = "</urlset>";


	//get all the active urls
	$activeURL = "SELECT M.path, `date_posted` FROM `".$tprefix."_content` C INNER JOIN `".$tprefix."_meta` M ON M.meta_id = C.meta_id WHERE M.type = 'post' ORDER BY `date_posted` DESC";
	echo $activeURL;
	$result = $db->query($activeURL);


	while($row = $result->fetch_assoc()){
		$url[] = $row["path"];
		$lastmodified[] = $row["date_posted"];
	}

//print_r($lastmodified);
//open the file and write the sitemap header then closes it
$handle  = fopen($destPath.$outputFile, 'w');
fwrite($handle,$header);
fclose($handle);

//open in append mode
$handle  = fopen($destPath.$outputFile, 'a');

for($i=0;$i<count($url);$i++){
	fwrite($handle, "\n<url>\n");
	fwrite($handle,"<loc>".$url[$i]."</loc>\n");
	fwrite($handle,"<lastmod>".$lastmodified[$i]."</lastmod>\n");
	fwrite($handle, "</url>\n");

}
fwrite($handle,$footer);
fclose($handle);

}


/*
==================================================================
Example of sitemaps w/all tags even the optional
up to 50,000 urls can be included in one file less than 10MB, use utf-8 encoding,
==================================================================
<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <url>
      <loc>http://www.example.com/</loc>
      <lastmod>2005-01-01</lastmod>
      <changefreq>monthly</changefreq>
      <priority>0.8</priority>
   </url>
   <url>
      <loc>http://www.example.com/catalog?item=12&amp;desc=vacation_hawaii</loc>
      <changefreq>weekly</changefreq>
   </url>
   <url>
      <loc>http://www.example.com/catalog?item=73&amp;desc=vacation_new_zealand</loc>
      <lastmod>2004-12-23</lastmod>
      <changefreq>weekly</changefreq>
   </url>
</urlset>
==================================================================
//example of sitemap files inclusion : sitemap index file
==================================================================
<?xml version="1.0" encoding="UTF-8"?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
   <sitemap>
      <loc>http://www.example.com/sitemap1.xml.gz</loc>
      <lastmod>2004-10-01T18:23:17+00:00</lastmod>
   </sitemap>
   <sitemap>
      <loc>http://www.example.com/sitemap2.xml.gz</loc>
      <lastmod>2005-01-01</lastmod>
   </sitemap>
</sitemapindex>

==================================================================
if the Sitemap is located at http://www.example.com/sitemap.xml, 
it can't include URLs from http://subdomain.example.com, 
similarly U cannot mix protocols:

http://example.com/image/show?item=23
http://example.com/image/show?item=233&user=3453
https://example.com/catalog/page1.php
    ^ 

==================================================================

==================================================================
//U can host sitemap files on external host, simply modifiy the robots.txt as follow
==================================================================
if the sitemap of www.host1.com is hoste in www.sitemaphost.com, then :
Snippet in the robots.txt of *www.host1.com*
>>Sitemap: http://www.sitemaphost.com/sitemap-host1.xml


Submit sitemap to search engine thru http request :
>>www.google.com/ping?sitemap=http://www.example.com/sitemap.gz
URL encode everything after the /ping?sitemap=:
>>www.google.com/ping?sitemap=http%3A%2F%2Fwww.yoursite.com%2Fsitemap.gz

You can issue the HTTP request using wget, curl, or another mechanism of your choosing. 
A successful request will return an HTTP 200 response code; 
if you receive a different response, you should resubmit your request


==================================================================
source:http://www.sitemaps.org/protocol.php ; sitemap valisation notes not included here
==================================================================
*/?>

