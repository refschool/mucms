			<div id="head">
				<div id="branding">
					<img src="<?=$tld2.$install_folder .$themepath?>images/banner.jpg" width="" height="" alt="<?=$home_title?>" />
				</div>	



	<?php 
	//$hook['menu'][0]();
	hook_insert('menu'); 

	?>
			</div>