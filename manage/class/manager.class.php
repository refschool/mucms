<?php

//variables for a complete post from content table

class Manager {

	public $id = '';
	public $title = '';
	public $cat= '';
	public $sefurl = '';
	public $description= '';
	public $keyword = '';
	public $h1_title = '';
	public $author = '';
	public $date_posted = '';
	public $social_body_text = '';
	public $thisurl = '';
	public $main_text = '';
	public $lang = '';
	public $readmore = '';
	public $published = '';

	public $tag_anchor = '';

	//meta tag


//===============================================

function getLatestLinkId(){
global $db;global $tprefix;
		$sql="select max(link_id) from `".$tprefix."_links`";
//		echo $sql2;
		$r = $db->query($sql);
		$m = $r->fetch_assoc();
		$max = $m['max(link_id)']+1;
		
		return $max;
}
/*
* This function show the content of a given post based on its id (from content table)
* used in the editor
*/


/*
This function will list ALL the posts by creation order
it is the most general display possible since ALL the posts are listed
*/
function showAllPosts ($howmany){
	global $tld;global $db; global $tprefix;

//query to show the latest posts
$showLastArticle = "select `id`,`cat`,`title`,`thisurl`,`published` from `".$tprefix."_content` order by id desc LIMIT ".$howmany;

//echo $showLastArticle;
 
$result = $db->query($showLastArticle);

//display the header of the table

echo '<div id="listing">';
echo '
<table class="collapse"><tr>
<td class="hlabel">ID</td><td class="hlabel">Category</td><td class="hlabel" width="250">Title</td><td class="hlabel">Preview</td><td class="hlabel">Pub.</td><td class="hlabel">Preview</td></tr>';


while($line = $result->fetch_assoc()){
		//content table
 		$id = $line["id"];
		$cat=$line["cat"];
		$title=$line["title"];
		$thisurl=$line["thisurl"];
		$published = $line["published"];
		echo '<tr>';

//display the datas of the table		
		echo '<td class="data">'.$id.'</td><td class="data">'.$cat.'</td><td class="data"><a href="'.$tld.'manage/write.php?id='.$id.'">'.$title.'</a></td><td class="data"><a href="'.$thisurl.'" target="_blank" >View</a></td><td class="data">'.$published.'</td><td class="data"><a href="javascript:ajax('.$id.');">Preview</a></td></tr>';
     }
	 echo '</table>';
	 echo '</div>';
}

/*
This function will fetch and display the posts for a given category
if $cat = news, then it will list  the 30 first post that are filed under 'news' category
the $howmany parameter defines the number of results, it is set at 100 by default
*/
function showPostsOfCategory($category,$howmany = 100){
  global $tld;global $db;global $tprefix;
 
$showSelectedCategory = "select `id`,`cat`,`title`,`thisurl`,`published` from `".$tprefix."_content` where `cat` = '".$category."' order by `id` DESC LIMIT ".$howmany;

$result = $db->query($showSelectedCategory);

//display the header of the table
echo '
<table class="collapse"><tr>
<td class="hlabel">ID</td><td class="hlabel">Category</td><td class="hlabel" width="250">Title</td><td class="hlabel">This Url</td><td class="hlabel">Pub.</td><td class="hlabel">Preview</td></tr>';

while($line = $result->fetch_assoc()){
		//content table
 		$id = $line["id"];
		$cat=$line["cat"];
		$title=$line["title"];
		$thisurl=$line["thisurl"];
		$published = $line["published"];
		echo '<tr>';

//display the datas of the table		
		echo '<td class="data">'.$id.'</td><td class="data">'.$cat.'</td><td class="data"><a href="'.$tld.'manage/write.php?id='.$id.'">'.$title.'</a></td><td class="data"><a href="'.$thisurl.'" target="_blank" >View</a></td><td class="data">'.$published.'</td><td class="data"><a href="javascript:ajax('.$id.');">Preview</a></td></tr>';
     }
	 echo '</table>';

}
	
/*
This function append the year and month folder to the path of the image url
*/
function getCurrentImageSubDir() {
	//display year and month
	//$currentimagedir = substr(date('Y-m'),0,4).'/'.substr(date('Y-m'),5,6).'/' ;
	//display year only 
	$currentimagedir = date('Y').'/'.date('m') . '/';
	return $currentimagedir;
}

function getCategories($db, $tprefix, $tld){

$sql = "SELECT DISTINCT `cat` FROM `".$tprefix."_content` order by `cat` asc";
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()){
		$categoryList[] = $row["cat"];
	}
	
	return $categoryList;
	}

function showArray($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}	


//============================
//		Code for the browser module
//============================

function display_footer_link(){
global $db; global $tprefix; global $tld;


}

function retrieve_links($post_id){
	global $db; global $tprefix; global $tld;

	
	$sql = "select * from `$tprefix"."_links` where `post_id` != 0 AND  `post_id` = $post_id  ";//echo $sql;
	$result = $db->query($sql);$k=0;
	if($result){
			while($row=$result->fetch_assoc()){
				$links[$k]['link_id'] = $row['link_id'];
				$links[$k]['post_id'] = $row['post_id'];
				$links[$k]['topic']  = $row['topic'];
				$links[$k]['url']  = $row['url'];
				$links[$k]['alt']  = $row['alt'];
				$links[$k]['anchor']  = $row['anchor'];
				$links[$k]['misc']  = $row['misc'];
				$k++;
			}

		return $links; 
		} else 
		{ 
			return FALSE;
		}
}



/*
	function for the image manager
*/

function thumbize($img_info){

	$width = $img_info[0];
	$height= $img_info[1];
	$aspect = $width/$height; //echo 'aspect ratio = '.$aspect;
	
	if($width >= $height){ $width = 150; $height=round($width/$aspect);}
	elseif($height > $width){ $height = 150; $width = round($height * $aspect);}
	
	$img_info[5]= $width;
	$img_info[6]= $height;
	
	return $img_info;
}
	
	
}




