
<div id="tabs">

<form name="writeform" method="POST" action="updateandcontinue.php" enctype="multipart/form-data">
	<?php 
	if(isset($_GET['id'])){
		$editid = $_GET['id'];
		$post = get_post_content($editid); 
	}
		?>


			<div id="tabs-1">
				<div class="uk-grid " style="margin-top:10px">
			
					<div class="uk-width-1-4 ">
						<div class="uk-center-left">
							<label style="cursor:pointer;">
								<input class="uk-radio" type="radio" name="published" value="Y" <?php if($post['published'] == 'Y'){echo "checked";} else {echo "";}?>> <span class="label">Publish</span>
							</label><br>
							<label  style="cursor:pointer;">
								<input class="uk-radio" type="radio" name="published" value="N" <?php if($post['published'] == 'N'){echo "checked";} else {echo "";}?>> 
								<span class="label">Unpublish</span>
							</label>
						</div>	
					</div>

					<div class="uk-width-1-4">
						Post Id<br/>
						<input type="text" readonly name="id" class="uk-input" maxlength="10" value="<?php if(!isset($editid)){echo get_latest_post_id(); } else {echo $post['id']; }?>"><br>
						<input type="hidden" name="meta_id" value="<?=$post['meta_id']?>" />
					</div>	

					<div class="uk-width-1-4">
						Date Posted<br/>
						<input type="text" name="date_posted" class="uk-input" maxlength="19" value="<?php
						if (!isset($editid)){echo date('Y-m-d H:m:s');} else {echo $post['date_posted'];} ?>">
					</div>	

					<div class="uk-width-1-4">
						<label style="cursor:pointer;">
							<input class="uk-checkbox" type="checkbox" name="com_closed"  value="checked" <?=$post['com_closed'];?>><span class="label">Closed to comment</span>
						</label>
					</div>	
				</div>



				<div class="uk-grid">
					<div class="uk-width-1-3">
						Author<br/>
						<input tabindex="1" type="text" name="author" class="uk-input" maxlength="40" value="<?php
						if (empty($post['author'])){echo $authorname;} else {
							echo $post['author'];} ?>">
						</div>

						<div class="uk-width-1-3">
							Tags<br/>
							<input tabindex="2" type="text" id="tag" name="tag" class="uk-input" maxlength="120" value="<?php echo get_tags_as_string($editid); ?>">
						</div>

						<div class="uk-width-1-3">
							<span class="uk-fieldset" style="cursor:pointer;border-radius:3px;border:1px solid #aaa;padding:3px;" onclick="javascript:toggleMeta();preventDefault();">Show/Hide Meta</span>
						</div>
				</div>


				</div>

				<?php include('includes/metadata.php') ?>

				<div class="uk-grid">
				<!-- title -->
					<div class="uk-width-1-1">
						<input tabindex="20" onkeyup="sefurlize('<?=$base_url?>')"  type=text id="title" name="title" class="uk-input" maxlength="120" value="<?php echo $post['title'];?>">
					</div>
				<!-- permalink -->
					<div class="uk-width-1-1">
						<a class="uk-form-icon" href="#" uk-icon="icon: pencil"></a>
						<input tabindex="21" type=text id="thisurl" name="thisurl" class="uk-input" maxlength="300" value="<?=$post['path']; ?>">
					</div>
				</div>


				<textarea tabindex="22" id="main_text" name="main_text" rows="25" class="mceEditor">
				<?php echo $post['main_text'];?>
				</textarea>
			</form>
			<br>
			<input tabindex="23" class="uk-input" type="submit" Value="Update" style="cursor:pointer">
		<!-- END OF BODY ELEMENTS-->


		<!-- END OF META  -->		
		<div id="tabs-2">
			<fieldset>

				<legend>Category tree</legend>
				<?php
				include("category-tree.php");
				?>

			</fieldset>	
		</div>

		<!-- COMMENTS-->
		<div id="tabs-3">
			<?php
				include('comments.php');
			?>
		</div>



		<div id="tabs-4">
			<p>Modifications</p>
			<textarea name="post_note" rows="10" cols="90"><?=$post['note']?></textarea>
			<input type="submit" Value="Update" >
		</div>


	</div><!--end id="tabs"-->
