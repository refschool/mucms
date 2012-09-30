<?php 
include("../inc/config.php");
include("class/manager.class.php");

$myMan = new Manager();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>IFRAME IMAGE URL COPY</title>
</head>
<body>

<form enctype="multipart/form-data" action="copyimage.php" method="post" target = "imagecopytargetframe">
<label for="imgurl">Image url + name</label><br />
	<input type="text" name="imageurl" size="50" value="" />
	<input type="text" name="imagename" size="50" value="<?php
		if (!isset($editid) || empty($myMan->image_url)){
			echo '../content/images/' . $myMan->getCurrentImageSubDir(); } 
			else {echo $myMan->image_url;} ?>" />
	<input type="submit" value="Get Image" />
</form>
<!-- 
Tu crées un iframe que tu nommes en fixant son attribut name.

Ensuite tu fixes l'attribut target de ton form avec le nom de l'iframe.

Ceci va poster le formulaire de manière tout a fait traditionnelle mais
le résultat renvoyé par le serveur se fera dans l'iframe ce qui évite de
recharger ta page principale.

Dans la réponse du serveur tu renvoie un script qui appelle la fonction de
ton choix dans ta page principale avec la notation: parent.nom_funct();
et le tour est joué. 


-->
</body>
</html>