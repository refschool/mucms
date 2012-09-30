<?php
include("../inc/config.php");
include("class/manager.class.php");
include("class/manager-functions.php");

		$existing_post_tags = get_post_tags(4);
		echo '<h2>Existing POST tag</h2>';		
		 pretty($existing_post_tags);