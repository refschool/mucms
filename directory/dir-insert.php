<?php session_start();
include('../inc/config.php');
include('inc/dir-setting.php');

$datetime = date('Y-m-d H:i:s');


// TODO control script + JS char counter??

$website_name = addslashes(trim($_POST['website_name']));
$website_url = addslashes(trim($_POST['website_url']));
$email = addslashes(trim($_POST['email']));

$cat_id = $_POST['cat_id'];

$short_desc = addslashes(trim($_POST['short_desc']));
$long_desc = addslashes(trim($_POST['long_desc']));

$street = addslashes(trim($_POST['street']));
$street2 = addslashes(trim($_POST['street2']));
$postcode = addslashes(trim($_POST['postcode']));
$city = addslashes(trim($_POST['city']));

$country = addslashes(trim($_POST['country']));
$phone = addslashes(trim($_POST['phone']));

$twitter = addslashes(trim($_POST['twitter']));
$facebook = addslashes(trim($_POST['facebook']));

$backlink_page = addslashes(trim($_POST['backlink_page']));



$msg = addslashes(trim($_POST['msg']));


//  put data in SESSION for easy correction
$_SESSION['website_name'] = $website_name;
$_SESSION['website_url'] = $website_url;
$_SESSION['email'] = $email;
$_SESSION['short_desc'] = $short_desc;
$_SESSION['long_desc'] = $long_desc;

$_SESSION['cat_id'] = $cat_id;

$_SESSION['street'] = $street;
$_SESSION['street2'] = $street2;
$_SESSION['postcode'] = $postcode;
$_SESSION['city'] = $city;
$_SESSION['country'] = $country;

$_SESSION['phone'] = $phone;
$_SESSION['twitter'] = $twitter;
$_SESSION['facebook'] = $facebook;
$_SESSION['backlink_page'] = $backlink_page;

$_SESSION['msg'] = $msg;

// DATA CONTROL
// 
// 
if(empty($email)){
	?>
	<p>Veuillez entrer un email très important pour la suite.
	<a href="javascript:history.go(-1)">Retour</a>

	<?php
	exit;
}




if(strlen($short_desc) < $short_desc_mini_char){
	?>
	<p>Description courte trop courte.
		<a href="javascript:history.go(-1)">Retour</a>

	<?php
	exit;
	
}


if(strlen($long_desc) < $long_desc_mini_char){
	?>
	<p>Description longue trop courte.<a href="javascript:history.go(-1)">Retour</a></p>

	<?php
	exit;
	
}

//insertion dans la table dir_entry
$sql = "insert into `".$tprefix."_dir_entry` (`cat_id`,`website_name`, `website_url`,`email`,`short_desc`,`long_desc`,`street`,`street2`,`postcode`,`city`,`country`,`phone`,`twitter`,`facebook`,`status`,`backlink_page`,`datetime`) values ('$cat_id','$website_name','$website_url','$email','$short_desc','$long_desc','$street','$street2','$postcode','$city','$country','$phone','$twitter','$facebook','pending','$backlink_page','$datetime')";
	echo $sql.'<br>';
	$db->query($sql);

//last insert id
$last_id = $db->insert_id;


//la creation de l'url dans la table meta sera faite dans le backend

//envoyer le email de confimation
// dans un premier ne nécesite pas la création d'un compte

//destroy session variable
session_destroy();
//END OF METADATA PROCESSING
echo "<meta http-equiv='refresh' content='10; url=". $_SERVER['HTTP_REFERER']."'>";
$db->close();