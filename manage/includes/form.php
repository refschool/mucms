<?php 
include("../inc/config.php");
$year = date('Y');
$month = date('m');
$imgdir = "../content/images/".$year."/".$month."/";
$imgurl = $tld."content/images/".$year."/".$month."/";

 ?>
<div id="uploader">
	<div id="imagefolderbrowser" >
	<!--  AJAX call imagefolderresponse.php-->
	</div>

	<iframe id="targetframe" name="targetframe" src="includes/iframedchildform.php" width="300" height="200" onload="listimagefolder('2009/07/')">
	  <p>Your browser does not support iframes.</p>
	</iframe>
</div>
<span id="testecho"></span>
<br style="clear:both" />
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