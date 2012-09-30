<?php
//Date 20/11/10
$cmsVersion = '1.2.0';


/* Function summary
 * Class PageLayout
 * retrieve the related element, 
 */

class PageLayout {

/*
	This function retrieves the elements in the links table for a given topic
	related,menu, footer, etc
*/
	function getLinkItems($topic) {
		global $tprefix; global $tld;global $db;
		$id = array();	$url = array();	$alt = array();	$anchor = array();$linklist=array();
		
		//read links table and retrieve id, url, alt, anchor
		//put into an array
		
		$sql = "select `link_id`,`url`,`alt`,`anchor` from `$tprefix"."_links` where `topic` = '$topic' order by `link_id` asc";// echo $sql;

		$result = $db->query($sql);
		if($result){
			while($line = $result->fetch_assoc()){
				$linklist[] = array('id' => $line["id"], 'url' => $line["url"], 'alt' => $line["alt"], 'anchor' => $line["anchor"]);
										}
				}
			
		return $linklist;
	}
	
	
	

		function getRelated($post_id,$topic){
		global $tprefix; global $tld;global $db;

		//read links table and retrieve id, url, alt, anchor
		//put into an array
		
		$sql = "select `link_id`,`url`,`alt`,`anchor` from `$tprefix"."_links` where `topic` = '$topic' and `post_id` = '$post_id' order by `link_id` asc"; //echo $sql;

		$result = $db->query($sql);
		if($result){
			while($line = $result->fetch_assoc()){
				$relatedList[] = array('id' => $line["id"], 'url' => $line["url"], 'alt' => $line["alt"], 'anchor' => $line["anchor"]);
										}
				}

		return $relatedList;		
		}

}

/*
 * this class is used for all related to comments actions
 * retrieve comments, post comment, print comment form, Akismet API
 */
 class Comments {

	public $comment = '';
 
 function showCommentForm($post_id) {
 	global $tprefix; global $tld;
	
	$form = '
	<div id="comment">
	<p>Leave a Comment</p>
	<form method="post" action="'.$tld.'content/comment.php">
	<input type="text" name="name" value="" maxlength="100" />Name*<br />
	<input type="text" name="email" value="" />E-mail*<br />
	<input type="text" name="website" value="" />Website<br />
	<input type="hidden" name = "post_id" value = "'. $post_id .'"/>
	<textarea  rows="8" cols="40" name="comment"></textarea><br />
	<input class="submit" type="submit" value="Submit"/>
	</form>
	</div>
	<br style="clear:both" />';
	
	return $form;
 
  }

  
  
  
  function fetchComments($conn,$postid){
	global $tprefix; global $tld;
	
	$sql = "select * from `$tprefix"."_comments` where `post_id` = $postid and `status` = 'P' order by `timestamp` asc";
	//echo $sql;
	$result = $conn->query($sql);
	
	//
	if($result){
		while($rows = $result->fetch_assoc()){
		
			$commentsArray[] = array('commentId' => $rows['comment_id'],
									'postid' =>$rows['post_id'],
									'name' =>$rows['name'],
									'email' =>$rows['email'],
									'website' =>$rows['website'],
									'comment'=>$rows['comment'],
									'timestamp'=>$rows['timestamp']);
		
		
			}
		}
		

		return $commentsArray;
	}
 
 }
 
/*
 * This class is used to retrieve information from the content table
 * it can select an entire post
 * 
 */ 
 
class ContentRoll {

/*
	This function will retrieve the post information
	this function can retrieve a single post, multiple posts, post by category
*/
function showPosts ($conn,$start,$number,$type,$cat = '') {
	global $tprefix; /*
	$title = array();	$image_url = array();	$social_body_text = array();
	$date_posted = array();	$thisurl = array();	$outputArray = array();*/
	
	//the sql request
	switch($type){
	case 'bycat':
	$sql="select * from `$tprefix"."_content` where `published` = 'Y' AND `cat`= '$cat' order by `date_posted` desc limit $start,$number";
	break;
	case 'bloglist':
	$sql="select * from `$tprefix"."_content` where `published` = 'Y' order by `date_posted` desc limit $start,$number";
	break;
	case 'single':
	$sql="select * from `$tprefix"."_content` where `sefurl` = '$sefurl'";//+related info tags, comments
	break;
	default:
	$sql="select * from `$tprefix"."_content` where `published` = 'Y' order by `date_posted` desc limit $start,$number";
	break;
	}
	
	//echo $sql;
	$result = $conn->query($sql);

	if($result){
	while($line = $result->fetch_assoc()){

	$outputArray[]= array(	'title' => ucwords($line["title"]),
						'description' =>$line["description"],
						'keyword' =>$line["keyword"],
						'h1_title' =>$line["h1_title"],
						'image_url' => $line["image_url"],
						'image_alt'=>$line["image_alt"],
						'width'=>$line["width"],
						'height'=>$line["height"],
						'image_caption'=>$line["image_caption"],
						'author'=>$line["author"],
						'social_body_text' => $line["social_body_text"],
						'date_posted' => $line["date_posted"],
						'thisurl' => $line["thisurl"],
						'main_text'=>$line["main_text"],
						'lang'=>$line["lang"],
						'readmore'=>$line["readmore"]
					);
					}
			}
	return $outputArray;	
	}

}
