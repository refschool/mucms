<?php
//get the main part of the page body
function get_body(){
	global $content,$home_compact,$sefurl,$themepath;
	
	switch($content['type']){
	case 'error404':	
		echo '
			<h2>Error 404 Page Not Found</h2>
			<p>The Page you requested is not found.</p>';

	break;
			
	case 'index':
							if($home_compact){  
								for($i=0;$i<count($content['page_element']);$i++){
							?>
								
									<div class="excerpt">
										<a href="<?=$content['page_element'][$i]['thisurl']?>"><h2><?=$content['page_element'][$i]['sub_title']?></h2></a>
										<p><?=$content['page_element'][$i]['social_body_text']?></p>
										<span class="readmore">&nbsp;<a href="<?=$content['page_element'][$i]['thisurl']?>"><?=$content['page_element'][$i]['readmore']?></a></span>
									</div>
									
							<?php
								}
										} else { 
										//full presentation
										
								for($i=0;$i<count($content['page_element']);$i++){		
										?>
										
									<div class="post">
										<div class="text">	
										<a href="<?=$content['page_element'][$i]['thisurl']?>"><h2 class="home"><?=$content['page_element'][$i]['sub_title']?></h2></a>
										<p><?=$content['page_element'][$i]['main_text']?></p>
										</div>
									</div>
										<?php
								
										//make a hook here
										?>
										
										<div class="comment-preview">
										<span class="date"><?=$content['page_element'][$i]['date_posted']?></span>
										<a href="<?=$content['page_element'][$i]['thisurl']?>">
											<span class="comments-count"><?= get_comment_nb($content['page_element'][$i]['id'])?>&nbsp;Commentaires</span>
										</a>
										</div>
										
								
								<?php
								}  						
						}
	

			break;			
		case 'thetag':	
					
					echo '<h1>Tag search results : </h1>';
					
					for($i=0;$i<count($content['page_element']);$i++){
					?>
					<h2><a href="<?=$content['page_element'][$i]['path']?>"><?=$content['page_element'][$i]['sub_title']?></a></h2>
					<p>Author :<?=$content['page_element'][$i]['author']?></p>
					<p><?=$content['page_element'][$i]['description']?><span class="readmore"><a href="<?=$content['page_element'][$i]['thisurl']?>"><?=$content['page_element'][$i]['readmore']?></a></span></p>
						
					<?php
						}
	
				
			break;
		case 'thecategory':
					//$category_list = get_category_list($sefurl);
					echo '<h1>Category search results : </h1>';
					
					
					for($i=0;$i<count($content['page_element']);$i++){
					?>
					<h2><a href="<?=$content['page_element'][$i]['path']?>"><?=$content['page_element'][$i]['sub_title']?></a></h2>
					<p>Author :<?=$content['page_element'][$i]['author']?></p>
					<p><?=$content['page_element'][$i]['description']?><span class="readmore"><a href="<?=$content['page_element'][$i]['thisurl']?>"><?=$content['page_element'][$i]['readmore']?></a></span></p>
						
					<?php
						}
			break;

		case 'thepost':
								echo '<div class="post">';
								echo '<h1>'.$content['page_element'][0]['sub_title'].'</h1>';
								
								hook_insert('after_post_title');
								
									echo $content['page_element'][0]['main_text'];
									
									hook_insert('end_of_post');

									echo '<p>Posté le ' . $content['page_element'][0]['date_posted'].'</p>';
								
								/*
									//get related posts
									$post_id = get_post_id($sefurl);
									$r = get_related_posts($post_id);
									if(!empty($r)){
									
									echo '<div id="related"><p style="font-weight:bold;font-size:16px; color:#FF7F00">Suggested readings<p>
												<ul>';
										for($i=0;$i < count($r);$i++){
											?>
											
											
												
												<li><a href="<?=$r[$i]['url']?>" ><?=$r[$i]['anchor']?></a></li>
	
											<?php

										}
										echo '</ul></div><br style="clear:both" />';
									}
								echo '</div><!--end of post div-->';
								
								//end related post
								//tODO put this in a function PLEASE
								*/	
									?>
									<br style="clear:both" />
									<?php 
									hook_insert('comment_count');
									hook_insert('comments');


									if($content['page_element'][0]['com_closed']  == 'checked'){
										echo '<p>Fermé aux commentaires</p>';
									}
										else {
											hook_insert('comment_form');
										}
									
									 
									
									?>
									



									
									<?php

									echo '</div>';
		
			break;


	case 'directory-home':

										
						for($i=0;$i<count($content['page_element']);$i++){		
										?>
										
							<div class="post">
								<div class="text">	
							<a href="<?=$content['page_element'][$i]['path']?>"><h2 class="home"><?=$content['page_element'][$i]['website_name']?></h2></a>
							
							<?=$content['page_element'][$i]['short_desc']?>
								</div>
							</div>
						<?php
								
							//make a hook here
							?>

								<?php
								 						
						}
	

			break;				




	case 'directory':

				
						?>
										
					<div class="post">
						<div class="text">	
							<a href="<?=$content['page_element']['website_url']?>"><h2 class="home"><?=$content['page_element']['website_name']?></h2></a>
							
							<?=$content['page_element']['short_desc']?>

							<?=$content['page_element']['long_desc']?>

						</div>
					</div>
										<?php
								
										//make a hook here
										?>
										

										
								
								<?php
													
					
	

			break;
		
		}

}



		//additionnal template insertion
		//hook_insert('body_addon');
