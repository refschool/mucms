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
						?>

					</tbody>
				</table>

				<?php
			}  else {
				echo 'no comment.';
			}
			?>
