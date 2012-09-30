<?php
include ("../inc/config.php");include("class/user.class.php");

//create Annuaire object
	$myUser = new User();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Demande de mot de passe<?php echo ' | '.$tUrl; ?></title>
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />
</head>



<?php 
$email = trim($_POST['email']);




 //create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
	
	
	
//select the user by email and get user ID
$sql = "select `user_id`,`username` from `$tprefix"."_users` where `email` = '$email'"; //echo $sql.'<br />';
	$get_user_id = $db->query($sql);
			if($get_user_id){
			$row = $get_user_id->fetch_assoc();
			$user_id = $row["user_id"];//echo 'user id = '. $user_id .'<br />';
			$username = $row["username"];
			}
			
			if(isset($user_id)){
			$newpassword = $myUser->generatePassword();
			$md5password = md5($newpassword );
			//update password field in DB

			$updateQuery = "UPDATE `$tprefix"."_users` SET `password`='".$md5password."' WHERE `user_id` = $user_id"; //echo $updateQuery;
				$db->query($updateQuery)or die("Echec de la MAJ, veuillez contacter l'administrateur du site $masteremail");

			//==========send new password by email=================

			//configure SMTP
			ini_set('SMTP','smtp.free.fr');
			ini_set('smtp_port','25');
			$to = $email;
			$subject =  'Votre nouveau mot de passe';
			//the important part The Headers
			//this enable the email in HTML type
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: Admin <'.$masteremail.'  >' . "\r\n";



			$message =  'Bonjour ' .$username. ', voici votre nouveau mot de passe : '. $newpassword .'<br />'; 
			$message .= '<a href="http://annuaire-auto-entrepreneurs.org/user/login.php" >Connectez vous pour le changer</a><br />';
			$message .= 'Vérifiez que ce mail ne soit pas dans votre dossier de spams.';
			mail($to, $subject, $message, $headers);mail($webmastermail, $subject, $message, $headers);
			?>
			
			<table class="centered-table"><tr><td>Le nouveau mot de passe vient de vous être envoyé à votre adresse indiquée. Vérifiez qu'il ne soit pas dans le dossier de spam. Pour vous en assurer ajouter <b><?php echo $webmastermail; ?></b> dans votre carnet d'adresse.<br />
			<a href="<?php echo $tld; ?>" >Revenir à la page d'accueil</a>
			</td></tr></table>
			
			<?php
			//log password generation message
			
			}
			else
			{
			?>
			
			<table class="centered-table"><tr><td>
			Ce email n'existe pas dans la base de données. Néanmoins si vous êtes sûr de votre 
			email veuillez contacter l'administrateur <b><?php echo $masteremail; ?></b> du site ou <a href="<?php echo $tld . "user/requestpassword.php"; ?>" >recommencez</a>.
			</td></tr></table>
			<?php
			
			//echo 'Ce email n\'existe pas dans notre base de donnée. .';
			//exit;
			}
			