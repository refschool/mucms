<div id="btabs">
	<ul>
		<li><a href="#btabs-1">Posts Manager</a></li>
	</ul>

	<div id="btabs-1"><!--  Post manager -->
		<div id="browsercat">
		<?php 
		//show the different categories
		//echo 'cat ='.$cat;
		$myMan->showCategories($db,$tprefix,$tld);?>
		</div>

		<div id="listing">
		<!--  AJAX call browserresponse.php-->
		</div>

		<div id="preview">
		<!--  AJAX call response.php-->
		</div>	
	</div>



</div>
