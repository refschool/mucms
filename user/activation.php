<?php
include("../inc/config.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}

$activationHash = $_GET['hash'];

$sql = "SELECT `hash` FROM `".$tprefix."_users` where `hash` = '".$activationHash."' AND `act_stat`= 'I'";
//echo $sql.'<br />';

$isActive = $db->query($sql);

/*if the account is still inactive then update the field `act_stat` 
 *else return message 'the account is already active'
*/
if(mysqli_num_rows($isActive)==1){
//the account is still inactive so modify the `act_stat` field
$sql = "UPDATE `".$tprefix."_users` SET `act_stat` = 'A' WHERE `hash` ='".$activationHash."';"; 
$user_id ='';
$select_user_id = "SELECT `user_id` FROM `".$tprefix."_users` WHERE `hash` ='".$activationHash."';";

$result = $db->query($select_user_id);
if($result){
	$row = $result->fetch_assoc();
	$user_id = $row["user_id"];
	}


$activation = $db->query($sql);
	if($activation){
								// the activation completed successfully
								//insert user_id in the other tables
								
								
								echo 'Votre compte est désormais actif. Loggez vous dans votre page pour 
									<a href="'.$tld.'user/login.php">compléter votre profil</a>';
								} else {
								
								//problem when trying to update database
								
								echo "Il y a eu un problème lors de l'activation, écrire à $masteremail. Toutes nos excuses.";
								//return to homepage
								 }
				}
else 
{
	//the account is already active display message and redirect
	echo "Votre compte a déjà été activé.
	<a href=\"".$tld."user/login.php\">Loggez vous dans votre page</a>";
}
