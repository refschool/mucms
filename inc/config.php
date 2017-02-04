<?php
$tld = 'http://localhost/';
$tld2 = 'http://localhost';

$install_folder = 'mucms';

$db = 'mucmsdev';
$host = 'localhost';
$user = 'root';
$pass = '';
$tprefix = 'mc';
$tUrl = 'lhost';
$home_title = 'mucms dev';
$home_description = '';
$home_keyword = '';
$feed = 'FEED';

$masteremail = 'todo@mucms.com';

$authorname = 'dev' ;
$themepath = 'template/default/';

//site configuration
$akismet_key = '04637fae8d1f';
$home_post_nb = 6;
$home_compact = FALSE;
$dynamic_menu = TRUE;
$dynamic_footer = TRUE;

//verification
$verify_hash['google'] = '';
$verify_hash['bing'] = '';

//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
?>
