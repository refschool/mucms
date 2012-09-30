<?php
include ("../inc/config.php");
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

<body>

<form method="post" action="rqpass.php" name="loginform" id="loginform">
	<table class="centered-table">
		<tr><td class="vform"><label for="email">Demande de nouveau mot de passe - entrez votre email</label><input class="bg" type="text" name="email" /></td></tr>
		<tr><td class="vform"><input class="btn" type="submit" name="login" id="login" value="Nouveau Mot De Passe" /></td></tr>
	</table>
</form>

		
</body>
</html>