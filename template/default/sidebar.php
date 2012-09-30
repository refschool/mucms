<?php
//sidebar

function get_sidebar(){
?>

	<div id="sidebar">
	<?php 
	hook_insert('sidebar_item');

		?>

	</div><!--end sidebar-->

<?php

}

//show the latest posts
function show_latest_posts($nb){
		$m = get_latest_post(10);	
	?>
	<div class="box">
		<h3>Dernières news</h3>
		<div class="boxdata">
		<ul>
			<?php
			for($i=0;$i<count($m);$i++){  ?>

			<li><a href="<?=$m[$i]['path']?>" ><?=$m[$i]['title']?></a></li>
				
			<?php
			}  //end for loop
			?>
	
		</ul><br style="clear:both" />
	</div>
</div>
	
	
	<?php
	
}

//show the tags
function show_sidebar_tag(){
	$m = get_link_tags('tag');
	
	?>
<div class="tagbox">
	<h3>Tagroll</h3>
		<div class="boxdata">
			<ul>
			<?php
			for($i=0;$i<count($m);$i++){  ?>

			<li class="tag"><a href="<?=$m[$i]['path']?>" ><?=$m[$i]['tag_label']?></a></li>
				
			<?php
			}  //end for loop
			?>
	
			</ul><br style="clear:both" />
		</div>
</div>
	
	
	<?php
	
}




//show the categories
//**modified to reflect new category structure 05-12-2011
function show_sidebar_category(){
	$m = get_link_cat('category');
	
	?>
	<div class="box">
		<h3>Catégories</h3>
		<div class="boxdata">
		<ul>
			<?php
			for($i=0;$i<count($m);$i++){  ?>

			<li><a href="<?=$m[$i]['path']?>" ><?=$m[$i]['cat_label']?></a></li>
				
			<?php
			}  //end for loop
			?>
	
		</ul><br style="clear:both" />
	</div>
</div>
	
	
	<?php
	
}
