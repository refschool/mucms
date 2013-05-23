<?php session_start();

//http://stackoverflow.com/questions/547821/two-submit-buttons-in-one-form
//
include("../../inc/config.php");
include("../../inc/debug-functions.php");
include('../inc/dir-functions.php');
include('../inc/dir-bo-functions.php');

//returns an array
$entry = get_entry($_GET['entryid']);
//pretty($entry);
//get the cateogries available
$cat = get_categories();
//pretty($cat);
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Directory Edit| <?=$tUrl?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content = "" />
<link rel="stylesheet" type="text/css" href="../../manage/css/manager.css" />
<script type="text/javascript" src="../../manage/js/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
<script type="text/javascript" >
tinyMCE.init({
        mode : "textareas",
		editor_selector :"mceEditor",
		/*entity_encoding : "raw",*/
		convert_urls : false,
        theme : "advanced",   //(n.b. no trailing comma, this will be critical as you experiment later)
		plugins:"wordcount,table,fullscreen",
		theme_advanced_buttons3_add : "fullscreen,tablecontrols,fontsizeselect",
		theme_advanced_toolbar_location : "top",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_toolbar_align : "left"
		
});
</script>
</head>
<body>
	<div id="frame">
<!--directory management interface-->
<!--list the entries-->
	<div id="header">
		<div id="menu">
			<?php
			include("../inc/menu.php");
			?>
		
		</div>
	</div>

		<div id="main" style="padding:50px 0 0 20px;width:960px;border:solid 2px #000">	
			<form method='post' action='dir-update.php' >
					<input type="hidden" name="entry_id" value="<?=$entry['entry_id']?>" />
					
					<h2>Informations principales</h2>
					<label>Nom</label>
					<input type="text" name="website_name" value="<?=$entry['website_name']?>" ><br>
					<label>URL</label>
					<input type="text" name="website_url" size="35" value="<?=$entry['website_url']?>" ><br>
					<label>Email</label>
					<input type="text" name="email" value="<?=$entry['email']?>" ><br>
					<label>Catégorie</label>

					<select name="cat_id">
					<?php
					//get all the existing categories id
					

					for($i=0;$i<count($cat);$i++){
						echo "<option ".($entry['cat_id'] == $cat[$i]['cat_id'] ? 'selected' : '')." value=\"".$cat[$i]['cat_id']."\" >".$cat[$i]['cat_name']."</option>\n";
						}
					?>
					
					</select>
					<br>

					<h2>Description courte</h2>
					<label for="short_desc">Short Description</label><br>
					<textarea cols="80" rows="2" id="short_desc" name="short_desc" class="mceEditor" ><?=$entry['short_desc']?></textarea>

					<h2>Description longue</h2>					
					<label for="long_desc">Long Description</label><br>
					<textarea cols="80" rows="4" id="long_desc" name="long_desc" class="mceEditor" ><?=$entry['long_desc']?></textarea>

					<h2>Adresse</h2>

					<label>n° et Rue</label><br />
					<input type="text" name="street" value="<?=$entry['street']?>" /><br />

					<label>Complement</label><br />
					<input type="text" name="street2" value="<?=$entry['street2']?>" /><br />

					<label>Code Postal</label><br />
					<input type="text" name="postcode" value="<?=$entry['postcode']?>" /><br />

					<label>Ville</label><br />
					<input type="text" name="city" value="<?=$entry['city']?>" /><br />

					<label>Pays</label><br />
					<input type="text" name="country" value="<?=$entry['country']?>" /><br />

					<label>Telephone</label><br />
					<input type="text" name="phone" value="<?=$entry['phone']?>" /><br />

					<h2>Profil social media</h2>

					<label>Profile Twitter (sans le @)</label><br />
					<input type="text" name="twitter" value="<?=$entry['twitter']?>" /><br />

					<label>Url Page Facebook</label><br />
					<input type="text" size="50" name="facebook" value="<?=$entry['facebook']?>" /><br /><br><br>


					<h2>Lien retour optionnel</h2>
					<label>Url page contenant le lien retour</label><br />
					<input type="text" name="backlink_page" value="<?=$entry['backlink_page']?>" /><br />

					<input type="submit" name="action" value="Update" >

					<!--do not display this if the website has been validated-->

					<?php

					if($entry['status'] =='approved'){

					} else {
						?>
					<input type="submit" name="action" value="Validate Website"><br><br><br>
						<?php
					}

							?>
					
				</form>
	</div>

	<div id="footer">
	<?=get_directory_version();?>
	</div>

</div>
</body>
</html>