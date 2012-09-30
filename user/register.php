<?php 
include ("../inc/config.php");include("../inc/class/core.class.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Créer un compte<?php echo ' | '. $tUrl; ?></title>
<meta name="description" content="" />
<meta name="keywords" content = "" />
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link rel="stylesheet" type="text/css" href="css/user.css" />
<link rel="shortcut icon" href="/favicon.ico" />

</head>
<body>

<?php
require_once('recaptchalib.php');
$publickey = "6LdNdwwAAAAAAI8VDvga7ygQGjHo3C-3AAk-UMKt"; // you got this from the signup page
?>

<script>
var RecaptchaOptions = {
   theme : 'white',
   tabindex : 2,
   lang : 'fr'
};
</script>

<div id="container">
<tr><h2>Créez votre compte</h2></tr>


<form method="post" action="register-insert.php" name="loginform" id="loginform">
	<table class="centered-table">
		<tr>
			<td class="vform">
			<label for="username">Pseudo(Seules les lettres et chiffres sont autorisés 6 caractères au minimum)</label>
			<input class="bg" type="text" name="username" id="username" />
			</td>
		</tr>
		
		<tr>
			<td class="vform">
			<label for="password">Password (min 8 char)</label>		
		<input class="bg" type="password" id="password" name="password" size ="20" maxlength="20" value="">
			</td>
		</tr>		
		
		<tr>
			<td class="vform">
			<label for="email">Email</label>
			<input class="bg" type="text" name="email" id="email" />
			</td>
		</tr>
		<tr>
			<td class="vform">
			<label for="email">Verify you are a human</label>
			<?php
			echo recaptcha_get_html($publickey);
			?>
			</td>
		</tr>
		<tr>
			<td class="vform">
			<input class="btn" type="submit" name="login" id="login" value="Submit" />
			</td>
		</tr>
	</table>
	</form>
	
</div>

</body>
</html>