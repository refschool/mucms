<?php session_start();

ini_set("include_path", ".:../:./inc:../inc:../../inc:../Smarty-2.6.19/libs");
 include("config.php");include("class/manager-functions.php");
 include("class/manager.class.php");

	
//write to config.php	
$config = stripslashes(trim($_POST['config']));
$file = '../../inc/config.php';
$handle = fopen($file,'w');
fwrite($handle,$config);
fclose($handle);

//write to plugin-config.php	
$plugin = stripslashes(trim($_POST['plugins']));
$file = '../../content/plugins/plugin-config.php';
$handle = fopen($file,'w');
fwrite($handle,$plugin);
fclose($handle);


$redirect = $tld."manage/settings/index.php"; echo "Redirecting to : " . $redirect;

echo "<meta http-equiv='refresh' content='0; url=$redirect'>";