<form name="browserform" method="POST" action="" enctype="multipart/form-data">
	<div id="btabs">
		<ul>
			<li><a href="#btabs-1">Posts Manager</a></li>
		</ul>

		<div id="btabs-1"><!--  Post manager -->
			<a href="#" id="close_browser"> [ X ] </a><br><table>
				<tr>
					<td valign="top">
						<div id="browsercat">
							<?php 
		//show the different categories
							show_categories();
							?>
						</div>
					</td>
					<td valign="top">

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
	</div>