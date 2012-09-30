<?php
$domain = 'http://' . $_SERVER['HTTP_HOST'];
$prefix = trim($_POST["prefix"]);
$host= trim($_POST["host"]);
$dbname = trim($_POST["dbname"]);
$user = trim($_POST["user"]);
$password = trim($_POST["password"]);
$hometitle = trim($_POST["hometitle"]);
$mainauthor = trim($_POST["mainauthor"]);

$author = $mainauthor;
$date = date('Y-m-d H:i:s');


echo $prefix .' '. $host .' '. $db .' '.$user .' '. $password .' '. $hometitle .' '. $mainauthor ;

//=========Create config.php========
//detect if file exist
if(file_exists('../inc/config.txt')){
	$confighandle  = fopen('../inc/config.txt', 'r');
	$newConfig = fread($confighandle, filesize('../inc/config.txt'));
	
	//write domain name
		$newConfig = preg_replace("|www.yourdomain.com|i",$_SERVER['HTTP_HOST'] ,$newConfig);
		$newConfig = preg_replace("|www.yourdomain2.com|i",$_SERVER['HTTP_HOST'] ,$newConfig);
	//write databasename
		$newConfig = preg_replace("/DB/",$dbname,$newConfig);
	//write host
		$newConfig = preg_replace("/HOST/",$host,$newConfig);
	//write user
		$newConfig = preg_replace("/USER/",$user,$newConfig);
	//write password
		$newConfig = preg_replace("/PASS/",$password,$newConfig);
	//write prefix
		$newConfig = preg_replace("/PREFIX/",$prefix,$newConfig);
	//write homepage title
		$newConfig = preg_replace("/TITLE/",$hometitle,$newConfig);
	//write brand domain name
		$newConfig = preg_replace("/yourdomain.com/",substr($_SERVER['HTTP_HOST'],4),$newConfig);
	//write main author name
		$newConfig = preg_replace("/AUTHOR/",$mainauthor,$newConfig);
	//write the feed path
		$feed = $domain . '/content/feed/atom.xml';
		$newConfig = preg_replace("/FEED/",$feed,$newConfig);
		
		
		
	//create config.php file

	$file = fopen('../inc/config.php','w');
	fwrite($file, $newConfig);
	fclose($file);
	fclose($confighandle);

	
		}
		else
		//non need to go further in the install process
		{
		echo 'the raw config file does not exist !';
		exit;
		}

		//===END OF config.php creation===

		include("../inc/config.php");

//=========Create database========



//make the connection to the database
echo 'HOST = '.$host.'USER = '.$user.'PASS = '.$pass.'DB = '.$dbname;
/*
@$db = new mysqli($host,$user,$password,$dbname);
	if (mysqli_connect_errno())
	{
		echo 'An Error  : could not connect to database. Try again';
		exit;
	}
*/
//queries
include("queries.php");
	
		//delete the original file
	//unlink('../inc/config.txt');
	
	
?>