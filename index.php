<?php session_start();
include('inc/config.php');
include('inc/functions.php');

//include hook functinos
include($themepath .'body.php');
include($themepath . 'sidebar.php');
/********************************
* 	dispatcher
*********************************/

require_once("router.php");
require_once('hooks.php');

/********************************
* 	plugins configuration
*********************************/
include("content/plugins/plugin-config.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php hook_insert('meta_title'); ?> | <?=$tUrl?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="<?php hook_insert('meta_desc');?>" />
	<meta name="keywords" content = "<?php hook_insert('meta_kw');?>" />
	<?php hook_insert('meta_robots'); ?>
	<?php hook_insert('verification'); ?>
	<link rel="stylesheet" type="text/css" href="<?=$themepath?>global.css" />
	<link rel="alternate" type="application/atom+xml" title="Atom 0.3" href="<?=$tld . 'content/feed/' ?>atom.xml" />
	<link rel="shortcut icon" href="<?=$tld.$themepath?>images/favicon.ico" type="images/x-icon" />
	<?php
//_-`-_HOOK::before_head_-`-_
//header script
	hook_insert('before_head');
	?>
</head>
<body>
	<?php 
//_-`-_HOOK::after_body-`-_
	hook_insert('after_body');
	?>
	<div id="superframe">
		<div id="frame">
			
			<!-- HEADER --><!--Website top image and menu -->
			<?php  
			include( $themepath . 'header.php');  
			

			?>

			
			<!--main macro block -->
			<div id="main">
				<!--start leftbar -->
				<div id="leftbar">
					
					<?php hook_insert('body',$content_type);
					
					
					
					?>
					
				</div><!--end leftbar-->

				<!-- begin sidebar-->
				
				<?php  
				
				hook_insert('sidebar');
			//  ?>
			

		</div><!--end main--><br style="clear:both" />



		<!-- begin footer-->
		<?php include( $themepath .'footer.php') ?>
		<!-- end footer-->
		
	</div><!--end frame-->
	
	
</div><!--end superframe-->
<?php
//echo memory_get_peak_usage().'<br>';
//echo memory_get_usage();
?>
<?php //_-`-_HOOK::before_body_-`-_ 
hook_insert('before_body');
?>
</body>
</html>
