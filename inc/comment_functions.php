<?php
/*
			COMMENTS
*/


/**
 * Get either a Gravatar URL or complete image tag for a specified email address.
 *
 * @param string $email The email address
 * @param string $s Size in pixels, defaults to 80px [ 1 - 2048 ]
 * @param string $d Default imageset to use [ 404 | mm | identicon | monsterid | wavatar ]
 * @param string $r Maximum rating (inclusive) [ g | pg | r | x ]
 * @param boole $img True to return a complete IMG tag False for just the URL
 * @param array $atts Optional, additional key/value attributes to include in the IMG tag
 * @return String containing either just a URL or a complete image tag
 * @source http://gravatar.com/site/implement/images/php/
 */
function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}


//get the number of comments
function get_comment_nb($post_id){
	global $tprefix; global $tld;global $db;
	
	$sql = "select count(*) C from `$tprefix"."_comments` where `post_id` = '$post_id' and `status` = 'P' ";
	//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $nb = $row['C'];

}


//fetch comments by post id
  function fetch_comments($post_id){
	global $tprefix,$tld,$db;
	
	$sql = "select * from `$tprefix"."_comments` where `post_id` = $post_id and `status` = 'P' order by `timestamp` asc";
	//echo $sql;
	$result = $db->query($sql);$k=0;
	
	//
	if($result){
		while($rows = $result->fetch_assoc()){
			$comments[$k]['comment_id'] = $rows['comment_id'];
			$comments[$k]['post_id']	= $rows['post_id'];
			$comments[$k]['name']	= $rows['name'];
			$comments[$k]['email']	= $rows['email'];
			$comments[$k]['website']	= $rows['website'];
			$comments[$k]['comment']	= $rows['comment'];
			$comments[$k]['timestamp']	= $rows['timestamp'];
			$k++;
			}
		}
		
		if(!empty($comments)){
			return $comments;
		} else {
			return FALSE;
		}
}
	
	
function get_comments($post_id){
global $post_id;
//get comments for a given post
$c = fetch_comments($post_id);


	for($i=0;$i < count($c);$i++){
	
		$g_url = get_gravatar( $c[$i]['email']);
		?>
		<div class="comment">
		<img src="<?=$g_url?>" style="float:left;margin:0 20px 0 0 "/> 
		<a href="<?=$c[$i]['website']?>"><?=$c[$i]['name']?></a>
		<p><?=$c[$i]['comment']?></p>
		<p><?=$c[$i]['timestamp']?></p>
		</div>
		
		<?php

		}
}

function comment_form(){
	global $tld2,$post_id,$install_folder;

?>
	<div id="comment-form">
		<p style="font-weight:bold;font-size:16px; color:#FF7F00">Leave a Comment</p>
		<form method="post" action="<?=$tld2?><?=$install_folder?>/comment-insert.php">
			<input type="text" name="name" value="" maxlength="100" />Name*<br />
			<input type="text" name="email" value="" />E-mail*<br />
			<input type="text" name="website" value="" />Website<br />
			<input type="hidden" name = "post_id" value = "<?=$post_id?>"/>
			<textarea  rows="8" cols="40" name="comment"></textarea><br />
		<input class="submit" type="submit" value="Submit"/>
		</form>
	</div>
	<br style="clear:both" />
	
	
	<?php
	}
	
function get_comment_count(){
global $post_id;
?>
		<div class="comment-preview">
			
				<span class="comments-count"><?= get_comment_nb($post_id)?>&nbsp;Commentaires</span>
			
		</div>
<?php
}