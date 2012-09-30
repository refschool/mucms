<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>AJAX images management</title>
<link rel="stylesheet" type="text/css" href="css/manager.css" />
<script type="text/javascript" src="includes/js/ajax.js"></script>
<script language="javascript" type="text/javascript">
</script>
</head>
<body onload="listimagefolder('');">

<form enctype="multipart/form-data" action="http://www.mucms.com/manager/uploader.php" method="post" target = "targetframe">
<label for="imgdir">Image directory</label><br />
<input type="text" id="imgdir" name="imgdir" size="80" value="" /><br />
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
Choose a file to upload: <input name="uploadedfile" type="file" /><br />
<input type="submit" value="Upload File" />
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