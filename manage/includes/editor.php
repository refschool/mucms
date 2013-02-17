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

<div class="info1">
	<table>
		<tr>
			<td>
				<label><input type="radio" name="published" value="Y" <?php if($post['published'] == 'Y'){echo "checked";} else {echo "";}?>> Publish</label>
			</td>	
			<td>
				<label><input type="radio" name="published" value="N" <?php if($post['published'] == 'N'){echo "checked";} else {echo "";}?>> Unpublish</label>
			</td>	
	
	
			
			<td>Post Id<br/>
				<input type="text" readonly name="id" size ="6" maxlength="10" value="<?php 
	 if(!isset($editid)){echo get_latest_post_id(); } else {echo $post['id']; }?>">
				<input type="hidden" name="meta_id" value="<?=$post['meta_id']?>" />
			</td>
			
			<td>Date Posted<br/>
				<input type="text" name="date_posted" size ="19" maxlength="19" value="<?php
if (!isset($editid)){echo date('Y-m-d H:m:s');} else {echo $post['date_posted'];} ?>">
			</td>
		</tr>
		<tr>
			<td>Author<br/>
				<input type="text" name="author" size ="20" maxlength="40" value="<?php
if (empty($post['author'])){echo $authorname;} else {
	echo $post['author'];} ?>">
			</td>
			<td colspan="3">Tags<br/>
				<input type="text" id="tag" name="tag" size ="50" maxlength="120" value="<?php echo get_tags_as_string($editid); ?>">
			</td>			
		</tr>		
		
	</table>
</div>	
	<table>
	
	</table>

			<a href="javascript:toggleMeta()">Show/Hide Meta</a>
<!--Metadatas hidden by default-->
<div id="metadata" >

		<table>
			<tr>
				<td>
					<label for="description">Description</label>
					<textarea cols="80" rows="2" id="description" name="description" onchange="copyDescription()"><?php echo $post['description'];?></textarea>
				</td>

			</tr>
			<tr>
				<td>
					<label for="social_body_text">Body text Intro</label>
					<textarea cols="80" rows="2" id="social_body_text" name="social_body_text"><?php echo $post['social_body_text'];?></textarea>	
					<label for="readmore">Readmore</label>
	<input type=text name="readmore" size ="50" maxlength="100" value="<?php echo $post['readmore'];?>"><br>
				</td>
			</tr>
		</table>



	<label>Keyword
	<input type=text name="keyword" size ="40" maxlength="100" value="<?php echo $post['keyword'];?>"></label>


	<?php
	$meta_array = fetch_meta_info($post['path']);


	//pretty($meta_array);
	//
	//
	?>



	<div class="subset">
		<label for="meta_robot">meta_robot</label>

		<input type=checkbox name="meta_robotCANONICAL" value="checked" <?php echo $meta_array["meta_canonical"]; ?>>CANONICAL
		<input type=checkbox name="meta_robotNOINDEX" value="checked" <?php echo $meta_array["meta_robot_index"]; ?>>NOINDEX
		<input type=checkbox name="meta_robotNOFOLLOW" value="checked" <?php echo $meta_array["meta_robot_follow"]; ?>>NOFOLLOW
		<input type=checkbox name="meta_robotNOARCHIVE" value="checked" <?php echo $meta_array["meta_robot_archive"]; ?>>NOARCHIVE
		<input type=checkbox name="meta_robotNOSNIPPET" value="checked" <?php echo $meta_array["meta_robot_snippet"]; ?>>NOSNIPPET	
		<input type=checkbox name="meta_robotNOODP" value="checked" <?php echo $meta_array["meta_robot_odp"]; ?>>NOODP
		<input type=checkbox name="meta_robotNOYDIR" value="checked" <?php echo $meta_array["meta_robot_ydir"]; ?>>NOYDIR<br />

		<label for="meta_googlebot">meta_googlebot</label><!-- http://www.google.fr/intl/fr/remove.html#remove_snippets-->
		<input type=checkbox name="meta_googlebot" value="checked">GoogleBOT Only<br />
		
		<label>Redirect to
		<input type=text name="redirect" size ="80" maxlength="200" value="<?php echo $post['redirect'];?>"></label>
		<label>Redirect type
		<input type=text name="redirect_type" size ="3" maxlength="3" value="<?php echo $post['redirect_type'];?>"></label>
	</div>
	
</div>	

<div class="info1">	
	<table>
		<tr>
			<td width="30">Title</td>
			<td>
				<input type=text id="title" name="title" size ="60" maxlength="120" value="<?php echo $post['title'];?>">
			<a href="javascript:sefurlize()">Sefurlize</a></td>
		</tr>
		
		<tr>
			<td>H1 title</td>
			<td>
				<input type=text name="h1_title" size ="60" maxlength="80" value="<?php echo $post['h1_title'];?>">
			</td>
		</tr>
		

		<tr>
			<td>Permalink</td>
			<td><?=$tld2 . $install_folder . '/'?>
			<input type=text id="thisurl" name="thisurl" size ="60" maxlength="300" value="<?=$post['query_string']; ?>">
<a href="<?=$post['path']?>">Preview</a>
			</td>
		</tr>
	</table>
</div>
	
	
<!--End of metadata-->

	<textarea id="main_text" name="main_text" rows="25" class="mceEditor"><?php echo htmlentities($post['main_text']);?></textarea>

	

	
	
	</form>
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

					<a href="<?=$install_folder?>/manage/comment-delete.php?post_id=<?=$post['id']?>">Delete ALL Spam</a><br><br>
					<?php

				for($i=0;$i<count($comments);$i++){

					
	
			?>
				<tbody>
					<tr style="border-bottom:solid 1px #aaa;">
					<td class="com_<?=$comments[$i]['status']?>" style="padding : 10px"><a href="<?=$comments[$i]['website']?>" title="<?=$comments[$i]['website']?>"><?=$comments[$i]['name']?></a>,<?=$comments[$i]['email']?><?=$comments[$i]['timestamp']?> Status:<?=$comments[$i]['status']?> : 
					<a id="<?=$comments[$i]['comment_id']?>" href="<?=$install_folder?>/manage/comment-delete.php?post_id=<?=$post['id']?>&com_id=<?=$comments[$i]['comment_id']?>">Delete</a>
						<br>
						<br>
						<br>
						<?=$comments[$i]['comment']?>
						
						</td>
					</tr>
				</tbody>
			</table>
	

	<?php

				}	//end for loop
			}  else {
				echo 'no comment.';
			}
		?>
			
	
	

	</div>

	<div id="tabs-4">
	<p>Modifications</p>
	<textarea name="post_note" rows="10" cols="90"><?=$post['note']?></textarea>
	</div>
	
	
	<div id="tabs-5">
		<a href="<?php $pingst = $tld.'manage/ping.php?url='.$post['path'];echo $pingst;  ?>">Ping Google</a>	<br />
		<a href="http://twitter.com/">Tweet this !</a><br />	
	</div>

<input type="submit" Value="Update" >
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
	<p style="font-size:30px;"><a href="<?=$tld2.$install_folder?>/manage/newpost.php">Create a New Post</a></p>
	</div>
	<?php
}
?>