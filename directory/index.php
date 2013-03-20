<?php session_start();
include('../inc/config.php');
include('../inc/functions.php');
require_once('../hooks.php');

include('inc/dir-setting.php');
include('inc/dir-functions.php');
include('inc/dir-bo-functions.php');

/********************************
* 	plugins configuration
*********************************/
include("../content/plugins/plugin-config.php");


//get the cateogries available
$cat = get_categories();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Directory | <?=$tUrl?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="description" content="" />
<meta name="keywords" content = "" />
<link rel="stylesheet" type="text/css" href="<?=$tld2.$themepath?>global.css" />
<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?=$tld2 . $install_folder . '/' .  $feed?>" />
<link rel="shortcut icon" href="<?=$tld2.$themepath?>images/favicon.ico" type="images/x-icon" />

<script type="text/javascript" src="../manage/js/tinymce/jscripts/tiny_mce/tiny_mce.js" ></script >
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
<div id="superframe">
		<div id="frame">
			
		<!-- HEADER --><!--Website top image and menu -->
			<?php  
			include( '../'.$themepath . 'header.php');  
				

			?>

			
		<!--main macro block -->
		<div id="main">
			<!--start leftbar -->
			<div id="leftbar">
				
				<h2>Formulaire</h2>
				<!-- Form V1 FR-->
				<form method='post' action='dir-insert.php' >

					<h2>Renseignement sur le site</h2>	

					<div class="text">
									
					<label>Nom du site web</label>
					<input type="text" size="40" maxlength="50" name="website_name" value="<?=( isset($_SESSION['website_name'])? $_SESSION['website_name'] : '' )?>" ><br>
					<label>URL du site web</label>
					<input type="text" size="50" name="website_url" value="<?=( isset($_SESSION['website_url'])? $_SESSION['website_url'] : '' )?>" ><br>
					<label>Email de contact</label>
					<input type="text" size="40" name="email" value="<?=( isset($_SESSION['email'])? $_SESSION['email'] : '' )?>" ><br>

					</div>

					<h2>Catégorie</h2>
					<div class="text">
					
						<select name="cat_id">
						<?php
						//get all the existing categories id
						

						for($i=0;$i<count($cat);$i++){
							echo "<option value=\"".$cat[$i]['cat_id']."\" ".( $_SESSION['cat_id'] == $cat[$i]['cat_id'] ? 'selected' : '').">".$cat[$i]['cat_name']."</option>\n";
							}
						?>
						
						</select>
					</div>


					<h2>Description courte</h2>
					<div class="text">

					
					<label for="long_desc">Short Description <?=get_short_desc_mini()?></label><br>
					<textarea cols="80" rows="2" id="short_desc" name="short_desc" class="mceEditor" ><?=( isset($_SESSION['short_desc'])? $_SESSION['short_desc'] : '' )?></textarea>
					</div>
					
					<h2>Description longue</h2>

					<div class="text">
					<label for="long_desc">Long Description <?=get_long_desc_mini()?></label><br>
					<textarea  cols="80" rows="25" id="long_desc" name="long_desc" class="mceEditor" ><?=( isset($_SESSION['long_desc'])? $_SESSION['long_desc'] : '' )?></textarea>
		

					</div>

					<h2>Adresse</h2>

					<div class="text">
					<label>n° et Rue</label><br />
					<input type="text" name="street" value="<?=( isset($_SESSION['street'])? $_SESSION['street'] : '' )?>" /><br />

					<label>Complement</label><br />
					<input type="text" name="street2" value="<?=( isset($_SESSION['street2'])? $_SESSION['street2'] : '' )?>" /><br />

					<label>Code Postal</label><br />
					<input type="text" name="postcode" value="<?=( isset($_SESSION['postcode'])? $_SESSION['postcode'] : '' )?>" /><br />

					<label>Ville</label><br />
					<input type="text" name="city" value="<?=( isset($_SESSION['city'])? $_SESSION['city'] : '' )?>" /><br />

					<label>Pays</label><br />
					<input type="text" name="country" value="France" /><br />

					<label>Telephone</label><br />
					<input type="text" name="phone" value="<?=( isset($_SESSION['phone'])? $_SESSION['phone'] : '' )?>" /><br />

					</div>	

					<h2>Profil social media</h2>

					<div class="text">

					<label>Profile Twitter (sans le @)</label><br />
					<input type="text" name="twitter" value="<?=( isset($_SESSION['twitter'])? $_SESSION['twitter'] : '' )?>" /><br />

					<label>Url Page Facebook</label><br />
					<input type="text" size="50" name="facebook" value="<?=( isset($_SESSION['facebook'])? $_SESSION['facebook'] : '' )?>" /><br />





				</div>

					<h2>Lien retour optionnel</h2>

					<div class="text">
						<p>Un lien retour est apprécié même si optionnel, votre site sera validé plus rapidement.</p>
					<label>Url ou se trouve le lien retour</label><br />
					<input type="text" size="50" name="backlink_page" value="<?=( isset($_SESSION['backlink_page'])? $_SESSION['backlink_page'] : '' )?>" /><br />

					<label>Code à copier et mettre sur votre page</label><br />
					<textarea cols="80" rows="4" name="backlink_code" value="" /><a href="http://www.mucms.com">Annuaire</a></textarea>

	<h2>Message pour le webmaster</h2>
					<label>Suggestion de categorie ou autre</label><br />
					<textarea cols="80" rows="4" name="msg" /><?=( isset($_SESSION['msg'])? $_SESSION['msg'] : '' )?></textarea>

					<br>
					<input type="submit" value="Soumettre mon site" ><br>

				</div>				
				</form>




				<!-- fin formulaire-->
			
			</div><!--end leftbar-->

			<!-- begin sidebar-->
			

			

</div><!--end main--><br style="clear:both" />



			<!-- begin footer-->
			<?php include( '../'.$themepath .'footer.php') ?>
			<!-- end footer-->
			
		</div><!--end frame-->
		
		
	</div><!--end superframe-->
<?php
//echo memory_get_peak_usage().'<br>';
//echo memory_get_usage();
?>

</body>
</html>
