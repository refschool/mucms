<html>
<head>
</title>Install MuCMS</title>
</head>

<body>
<style>
label {display:block;}
</style>


<fieldset><legend>Enter Parameters</legend>
<form method="POST" action="prefix.php" enctype="multipart/form-data" >

<label for="install_folder">Install Folder (if it's root leave it empty)</label>
<input type="text" name="install_folder" value="" /><br />

<label for="prefix">Table prefix</label>
<input type="text" name="prefix" value="" /><br />

<label for="host">Host</label>
<input type="text" name="host" value="" /><br />

<label for="dbname">Database name</label>
<input type="text" name="dbname" value="" /><br />

<label for="user">User</label>
<input type="text" name="user" value="" /><br />

<label for="password">Password</label>
<input type="text" name="password" value="" /><br />

<label for="hometitle">Homepage Title</label>
<input type="text" name="hometitle" value="" /><br />

<label for="mainauthor">Main Author</label>
<input type="text" name="mainauthor" value="" /><br />
<input type="submit" value="Generate sql file" />
</form>
</fieldset>
</body>
</html>