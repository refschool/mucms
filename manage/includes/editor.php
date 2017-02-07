<form name="writeform" method="POST" action="updateandcontinue.php" enctype="multipart/form-data">
<?php 
//if(!isset($editid)){$editid = 1;}
if(isset($_GET['id'])){
	$editid = $_GET['id'];
	$post = get_post_content($editid); 
	//pretty($post);
	?>
	
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Body Element</a></li>
		<li><a href="#tabs-2">Category</a></li>
		<li><a href="#tabs-3">Comments (<?=get_comment_nb($_GET['id'])?>)</a></li>
		<li><a href="#tabs-4">History
		<?php if(!empty($post['note'])){
			echo '(' . (str_word_count($post['note'])) .' words)';
		} else {
			echo 'Empty';
		}
		?>
		</a></li>		
		<li><a href="#tabs-5">Ping</a></li>
	</ul>
	
<div id="tabs-1">

<div class="uk-grid" style="margin-top:10px">
	<div class="uk-width-1-4">
		<label style="cursor:pointer;">
			<input type="radio" name="published" value="Y" <?php if($post['published'] == 'Y'){echo "checked";} else {echo "";}?>> Publish
		</label><br>
		<label  style="cursor:pointer;">
			<input type="radio" name="published" value="N" <?php if($post['published'] == 'N'){echo "checked";} else {echo "";}?>> 
			Unpublish
		</label>


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
		<input class="uk-checkbox" type="checkbox" name="com_closed"  value="checked" <?=$post['com_closed'];?>>Closed to comment
	</label>
	</div>	

</div>

<div class="uk-grid">
	<div class="uk-width-1-2">
		Author<br/>
				<input type="text" name="author" class="uk-input" maxlength="40" value="<?php
if (empty($post['author'])){echo $authorname;} else {
	echo $post['author'];} ?>">
	</div>
	<div class="uk-width-1-2">
		Tags<br/>
				<input type="text" id="tag" name="tag" class="uk-input" maxlength="120" value="<?php echo get_tags_as_string($editid); ?>">
	</div>

</div>


<!--Metadatas hidden by default-->

<br />
	<fieldset class="uk-fieldset">
		<legend class="uk-fieldset" style="border-radius:3px;border:1px solid #aaa;padding:3px;"><a href="javascript:toggleMeta()">Show/Hide Meta</a></legend>


<div id="metadata">		
		<table>
			<tr>
				<td>
					<label for="description">Description</label><br />
					<textarea cols="80" rows="2" id="description" name="description" onchange="copyDescription()"><?php echo $post['description'];?></textarea>
				</td>

			</tr>
			<tr>
				<td>
					<label for="social_body_text">Body text Intro</label>
					<textarea cols="80" rows="2" id="social_body_text" name="social_body_text"><?php echo $post['social_body_text'];?></textarea><br />	
					<label for="readmore">Readmore</label><br>
					<input type=text name="readmore" size ="50" maxlength="100" value="<?php echo $post['readmore'];?>"><br>
				</td>
			</tr>
		</table>
	


	<label>Keyword<br>
	<input type=text name="keyword" size ="40" maxlength="100" value="<?php echo $post['keyword'];?>"></label>


	<?php
	$meta_array = fetch_meta_info($post['path']);
	?>


	<div class="subset">
		<h2>meta_robot</h2>
		<label><input type=checkbox name="meta_robotCANONICAL" value="checked" <?php echo $meta_array["meta_canonical"]; ?>>CANONICAL</label>
		<label><input type=checkbox name="meta_robotNOINDEX" value="checked" <?php echo $meta_array["meta_robot_index"]; ?>>NOINDEX</label>
		<label><input type=checkbox name="meta_robotNOFOLLOW" value="checked" <?php echo $meta_array["meta_robot_follow"]; ?>>NOFOLLOW</label>
		<label><input type=checkbox name="meta_robotNOARCHIVE" value="checked" <?php echo $meta_array["meta_robot_archive"]; ?>>NOARCHIVE</label>
		<label><input type=checkbox name="meta_robotNOSNIPPET" value="checked" <?php echo $meta_array["meta_robot_snippet"]; ?>>NOSNIPPET</label>	
		<label><input type=checkbox name="meta_robotNOODP" value="checked" <?php echo $meta_array["meta_robot_odp"]; ?>>NOODP</label>
		<label><input type=checkbox name="meta_robotNOYDIR" value="checked" <?php echo $meta_array["meta_robot_ydir"]; ?>>NOYDIR</label>

		<h2>meta_googlebot</h2>
		<input type=checkbox name="meta_googlebot" value="checked">GoogleBOT Only</label><!-- http://www.google.fr/intl/fr/remove.html#remove_snippets-->
		
		<label>Redirect to<br />
		<input type=text name="redirect" size ="80" maxlength="200" value="<?php echo $post['redirect'];?>"></label>
		<label>Redirect type<br />
		<input type=text name="redirect_type" size ="3" maxlength="3" value="<?php echo $post['redirect_type'];?>"></label>
	</div>
	
</div>	

</fieldset>
<br />

<div class="uk-grid">
	<div class="uk-width-1-1">
		Title<br>
		<input type=text id="title" name="title" class="uk-input" maxlength="120" value="<?php echo $post['title'];?>">
		<a href="javascript:sefurlize()">Sefurlize</a>
	</div>
	<div class="uk-width-1-1">
		Permalink <br>
		<input type=text id="thisurl" name="thisurl" class="uk-input" maxlength="300" value="<?=$post['path']; ?>">

		<a href="<?=$post['path']?>">Preview</a>
	</div>
</div>
<!--End of metadata-->

	<textarea id="main_text" name="main_text" rows="25" class="mceEditor"><?php echo $post['main_text'];?></textarea>

	

	
	
	</form>
	<input type="submit" Value="Update" >
</div>
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

	
	<div id="tabs-3">
			<?php
				$comments = get_comments($post['id']);

				if(!empty($comments)){
					?>

				<table class="collapse">
					<thead class="header">
						<tr><th width="20">Comments</th></tr>
					</thead>
					<tbody>
					<a href="<?=$tld2?>/manage/comment-delete.php?post_id=<?=$post['id']?>">Delete ALL Spam</a><br><br>
					<?php

				for($i=0;$i<count($comments);$i++){
			?>
				
					<tr style="border-bottom:solid 1px #aaa;">
					<td class="com_<?=$comments[$i]['status']?>" style="padding : 10px"><a href="<?=$comments[$i]['website']?>" title="<?=$comments[$i]['website']?>"><?=$comments[$i]['name']?></a>,<?=$comments[$i]['email']?><?=$comments[$i]['timestamp']?> Status:<?=$comments[$i]['status']?> : 
					<a id="<?=$comments[$i]['comment_id']?>" href="<?=$tld2?>/manage/comment-delete.php?post_id=<?=$post['id']?>&com_id=<?=$comments[$i]['comment_id']?>">Delete</a>
						<br>
						<br>
						<br>
						<?=$comments[$i]['comment']?>
						
						</td>
					</tr>
	<?php
				}
					//end for loop
				?>

				</tbody>
			</table>

				<?php
			}  else {
				echo 'no comment.';
			}
		?>
	</div>
	<div id="tabs-4">
	<p>Modifications</p>
	<textarea name="post_note" rows="10" cols="90"><?=$post['note']?></textarea>
	<input type="submit" Value="Update" >
	</div>
	
	
	<div id="tabs-5">
		<a href="<?php $pingst = $tld.'manage/ping.php?url='.$post['path'];echo $pingst;  ?>">Ping Google</a><br />
		<a href="http://twitter.com/">Tweet this !</a><br />	
	</div>


</div>
<?php
} else {

	$post['id'] = '';
	$post['meta_id'] = '';	
	$post['title'] = '';
	$post['h1_title'] = '';
	$post['author'] = '';
	$post['date_posted'] = '';
	$post['social_body_text'] = '';
	$post['main_text'] = '';
	$post['lang'] = ''; 
	$post['readmore'] ='';
	$post['published'] = '';
	$post['note'] = '';
	
	$post['query_string'] = '';
	$post['path'] = ''; 
	$post['redirect'] = ''; 	
	$post['redirect_type'] = ''; 	
	$post['description'] = '';
	$post['keyword'] = ''; 	
	
	?>
	<div style="position:relative;width:300px;top:120px;margin-left:auto;margin-right:auto">
	<p style="font-size:30px;"><a href="newpost.php">Create a New Post</a></p>
	</div>
	<?php
}
?>
