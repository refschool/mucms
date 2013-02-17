<form name="browserform" method="POST" action="" enctype="multipart/form-data">
<div id="btabs">
	<ul>
		<li><a href="#btabs-1">Posts Manager</a></li>
		<li><a href="#btabs-2">Images Manager</a></li>
		<li><a href="#btabs-3">Bot visits</a></li>
		<li><a href="#btabs-4">Human Visits</a></li>
	</ul>

	<div id="btabs-1"><!--  Post manager -->
		<table>
			<tr>
				<td>
		<div id="browsercat">
		<?php 
		//show the different categories
		show_categories();
		?>
		</div>
	</td>
	<td>

		<div id="listing">
		<!--  AJAX call browserresponse.php-->
		</div>
</td>
</tr>
</table>

		<div id="preview">
		<!--  AJAX call response.php-->
		</div>	
	</div>

	<div id="btabs-2"><!--  AJAX image manager imagefolderresponse.php.php-->
	<?php 
	//include("image-browser.php");
	
	//include("form.php");
	?>
	
	<!-- test simulation wget -->
	<iframe id="imagecopytargetframe" name="imagecopytargetframe" src="iframedcopyform.php" width="350" height="200" >
	 <p>Your browser does not support iframes.</p>
	</iframe>
	</form>

	
		<div id="images">
		<!-- show the images imageresponse.php -->
		</div>
	</div>
	
	<div id="btabs-3"><!--  Promote  -->
	
		<?php
		include("includes/crawltrack.php");
		?>	
	</div>	

	<div id="btabs-4"><!--  Promote  -->
	
		<?php
		include("includes/crawltrack-human.php");
		?>	
	</div>	

	
</div>
