<?php
//use ftp wrapper http://fr.php.net/manual/fr/wrappers.ftp.php
$url = $_POST['imageurl'];//remote image url
$imagename = $_POST['imagename'];//local image path

//get the year&month of image name
preg_match('/\/[0-9]{4}\/[0-9]{2}/',$imagename,$m);
$year = substr($m[0],1,4);
$month = substr($m[0],6,2);

//if same filename exist exit()
if(file_exists($imagename))
{ 
	echo 'file already exists,<a href="javascript:history.go(-1)">choose another name</a>';
	exit;

} 

//detect if folder exist
if(file_exists('../content/images/'.$year.'/'.$month))
{ 
	//echo $year . ' already exists';
	//copy image
	copy($url,$imagename);
	echo $url . ' est copiée sur ' . '<br>';
	echo $imagename;
} 
else 
//nothing exist create the path and copy the file
{
	//recursive mkdir
	mkdir('../content/images/'.$year.'/'.$month,0755, TRUE); 
	//copy image
	copy($url,$imagename);
	echo $url . ' est copiée sur ' . '<br>';
	echo $imagename;
}
//add processing for file extension regex man!!
echo "<metas http-equiv='refresh' content='1; url=iframedcopyform.php'>";
?>
