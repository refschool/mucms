<?php session_start();
include("../inc/config.php");include("class/user.class.php");
//create connection object
	@$db = new mysqli($host,$user,$pass,$db);
	if (mysqli_connect_errno())	{	echo 'Error  : could not connect to database. Try again';	exit;	}
	
//create Annuaire object
	$annuaire = new User();
	
require_once('recaptchalib.php');
$privatekey = "6LdNdwwAAAAAAE8Ebj1P7odiKZyRjJXQyeLESwfN";
$resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
	//log connection sucess message
	$annuaire->_LOG($db, 'captchafail',$user_id, $username);
	
  die ("L'image n'a pas été décodé correctement. Revenez en arrière et recommencez.\n Sinon envoyez votre nom de connexion par email avec un petit message à $masteremail pour que l'administrateur crée manuellement votre compte.<a href=\"register.php\">Go back and retry</a> " .
       "(reCAPTCHA said: " . $resp->error . ")");
}


	
	
//configure SMTP
ini_set('SMTP','smtp.free.fr');
ini_set('smtp_port','25');
$to =  '';
$subject =  'Activez votre compte';
//the important part The Headers
//this enable the email in HTML type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= "From: $iTitle <$masteremail>" . "\r\n";
//get the POST variables

$username = strtolower($_POST['username']);
//test if username contains other than digits and letters
$i = preg_match('/[^a-z0-9-]/i',$username);
$usl = strlen($username);
//test if username begins with digit (which is invalid)
$j = preg_match('/^[0-9]/',$username);
//verifying password
$password = trim($_POST['password']);
$psl = strlen($password);

if($i==1){
	echo "Seules les lettres et chiffres sont autorisés.";
	echo "<meta http-equiv='refresh' content='2;$tld"."user/register.php' />";
	exit;
	}
if($j==1){
	echo "Le pseudo doit commencer par une lettre.";
	echo "<meta http-equiv='refresh' content='2;$tld"."user/register.php' />";
	exit;
	}
if($usl <= 5){
	echo "Pseudo trop court, 6 lettres/chiffres au minimum. Doit commencer par une lettre.";
	echo "<meta http-equiv='refresh' content='2;$tld"."user/register.php' />";
	exit;
}
if($psl <= 7){
	echo "Le mot de passe doit avoir au moins 8 caractères (lettres et/ou chiffres).";
	echo "<meta http-equiv='refresh' content='2;$tld"."user/register.php' />";
	exit;
}

	
	else {}

$ip=$_SERVER['REMOTE_ADDR']; 
$email = strip_tags($_POST['email']);
$tip_password = trim($_POST['password']);
$password = md5(trim($_POST['password']));
$crea_dat = date("Y-m-d H:i:s");
$hash = md5($username);

//checking the validity of the datas
//check usernamename uniqueness, email validity and uniqueness
$checkuserusername = $db->query("SELECT `username` FROM $tprefix"."_users WHERE username = '".$username."'");
    
if(mysqli_num_rows($checkuserusername)==1){
	echo "Désolé, ce nom utilisateur est déjà pris, veuillez en choisir un autre<a href=\"$tld"."user/register.php\">Retour Création Compte</a>";
	return;
	}
elseif (!eregi('^[a-zA-z0-9_\.-]+@[a-zA-z0-9_\-]+\.[a-zA-z0-9_\-\.]+$', $email))
	{
	echo 'veuillez vérifier votre email';
	}
else {
$sql = "INSERT INTO `$tprefix"."_users` ( `username` , `level`, `email`, `password` , `crea_dat`, `hash`, `reg_ip`,`act_stat` )
VALUES (
'".$username."','guest' ,'".$email."', '".$password."', '".$crea_dat."','".$hash."','".$ip."','I' )";


//Create the entry in the user primary table
$db->query($sql) or die("Erreur dans la création de votre compte, veuillez nous informer à l'adresse : $masteremail");

//get the user_id we just created
$get_user_id = "select `user_id` from `$tprefix"."_users` where `username` =  '$username'";
$result = $db->query($get_user_id);
if($result){
$row = $result->fetch_assoc();
$user_id = $row['user_id'];
}

//Confirmation message You made it !!
			$_SESSION['UserId'] = $user_id;
			$_SESSION['Username'] = $username;
		    $_SESSION['LoggedIn'] = 1;

echo "Merci, votre compte a été créé mais vous devez confirmer le lien dans le email pour le rendre actif. Vous allez recevoir un email de confirmation de création de votre compte. Vérifiez qu'il ne soit pas dans votre dossier de spam,  ajoutez l'expéditeur dans votre dossier de contact. Vous allez être redirigé dans un instant vers votre profil";


echo "<meta http-equiv='refresh' content='3; url=$tld"."user/$username'>";

//initialize $to
$to = $email;
$userid = $hash;
$message =  'Bonjour, votre login est '.$username.' et votre mot de passe est '. $tip_password .' , ';
$message .= ' <a href="'.$tld.'user/activation.php?hash='.$hash.'">Cliquez sur le lien suivant pour activer votre compte</a>';
$message .= 'Mettez ce email dans votre carnet de contact.';
mail($to, $subject, $message, $headers);
//echo '<br />'.$message;
}


?>
