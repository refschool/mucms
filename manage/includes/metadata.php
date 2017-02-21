					<!--Metadatas hidden by default-->
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
							<input type=text name="keyword" size ="40" maxlength="100" value="<?php echo $post['keyword'];?>">
						</label>

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
							<label><input type=checkbox name="meta_googlebot" value="checked">GoogleBOT Only</label><!-- http://www.google.fr/intl/fr/remove.html#remove_snippets-->

							<label>Redirect to<br />
								<input type=text name="redirect" size ="80" maxlength="200" value="<?php echo $post['redirect'];?>">
							</label>
							<label>Redirect type<br />
								<input type=text name="redirect_type" size ="3" maxlength="3" value="<?php echo $post['redirect_type'];?>">
							</label>
						</div>
					</div>