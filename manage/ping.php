<?php
$s = array("google" => "http://blogsearch.google.fr/ping",
"yahoo" => "http://search.yahooapis.com/SiteExplorerService/V1/ping");

$url = $_GET["url"];
//$service = $_GET["service"];

//====ping querystring====
$ping_google_qs = "url=".urlencode($url)."&btnG=Envoyer&hl=fr";
$ping_yahoo_qs = "sitemap=".$url;

$ping_qs = array ("google" => $ping_google_qs, "yahoo" => $ping_yahoo_qs);
//=========================

//echo $ping;

foreach($s as $service => $ping_uri){

	$curl = curl_init($ping_uri);
	curl_setopt($curl, CURLOPT_HEADER, 0);
	//curl_setopt($curl, CURLOPT_POST, true);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322; .NET CLR 2.0.50727)");
	curl_setopt($curl, CURLOPT_POSTFIELDS, "$ping_qs[$service]");
	$result = curl_exec ($curl);

	echo $service.'<br />';
	echo $result;

}
echo '<a href="'.$tld.'write.php">Return to Editor</a>';
