<?php
/*
 *   comment.php 04/04/2010
 *		Version 0.1
 */

//ini_set("include_path", ".:../:./inc:../inc:../../inc:");

require("inc/config.php");
include("inc/class/core.class.php");
include("inc/microakismet-1.2/class.microakismet.inc.php");


$comment = new Comments();

//get POST  variable
$name = $_POST['name'];
$email = $_POST['email'];
$website = $_POST['website'];
$comment = strip_tags($_POST['comment'],'<a>');
$post_id = $_POST['post_id'];
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];

// Now check if the comment is spam with Akismet
$vars = array();
	// Mandatory fields of information
   $vars["user_ip"]           	= $ip;
   $vars["user_agent"]        	= $user_agent;

	// The body of the message to check, the name of the person who
	// posted it, and their email address
   $vars["comment_content"]   	= $comment;
   $vars["comment_author"]			= $name;
   $vars["comment_author_email"]	= $email;
   
   $akismet = new MicroAkismet("$akismet_key","$tld","$tUrl");
   
	// Check if it's spam
	if ($akismet->check($vars)) {
		//it's a spam
		$sql = "insert into `$tprefix"."_comments` ( `post_id` , `name` , `email` , `website`,`comment`,`ip` ,`user_agent`, `status`  ) values ('$post_id','$name','$email','$website','$comment','$ip','$user_agent','U')";	//echo $sql;		
		
	}
	else {
		// it's not a spam
		$sql = "insert into `$tprefix"."_comments` ( `post_id` , `name` , `email` , `website`,`comment`,`ip` ,`user_agent`, `status`  ) values ('$post_id','$name','$email','$website','$comment','$ip','$user_agent','P')";//echo $sql;			
		
	}

/*insert the comment into the comments table if all verification passed
 statuses :  	U unpublished
				P published
				D deleted
				A awaiting moderation
				
				*/
//echo $sql;

$db->query($sql);
//END OF METADATA PROCESSING
echo "<META http-equiv='refresh' content='0; url=". $_SERVER['HTTP_REFERER']."'>";
$db->close();