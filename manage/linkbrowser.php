<div class="browser">
<?php
$postid = $_GET["postid"];
//********
		$sql2="select max(link_id) from `".$tprefix."_links`";
		$r = $db->query($sql2);
		$m = $r->fetch_assoc();
		$max = $m['max(link_id)']+1;
		
//this post show the different existing topics
/*
$showdiffCategories = "SELECT `cat` FROM `".$tprefix."_content` group by `cat` order by `cat` asc";
$diffCat = $db->query($showdiffCategories);
if($diffCat){
	while($line = $diffCat->fetch_assoc()){
	    $cat=$line["cat"];
echo '<a href="'.$tld.'manage/write.php?cat='.$cat.'">' . $cat . '</a>&nbsp;';
	}
}
*/

//this query shows links related to a post ID
$showSelectedCategory = "select `link_id`,`post_id`,`topic`,`url`,`alt`,`anchor`, `misc` from `".$tprefix."_links` where `post_id` = '".$postid."' order by `link_id` DESC LIMIT 30";

//this query shows all links ordered by link_id desc
$showLastArticle = "select `link_id`,`post_id`,`topic`,`url`,`alt`,`anchor`, `misc` from `".$tprefix."_links` order by link_id desc LIMIT 30";

//
if(!isset($zcat)){
		$last = $db->query($showLastArticle);
		} else
		{
		$last = $db->query($showSelectedCategory);
		}
//display the labels of the table		
echo '<h2>The latest links</h2>
<table class="collapse">
<tr>
<td class="hlabel">Link ID</td>
<td class="hlabel">Post ID</td>
<td class="hlabel">Topic</td>
<td class="hlabel" width="250">Link</td>
<td class="hlabel">Alt text</td>
<td class="hlabel">Miscellaneous</td>
</tr>';

//display the content of the table
if($last){
	while($ligne = $last->fetch_assoc()){
		//links table
 		$link_id = $ligne["link_id"];
		$post_id = $ligne["post_id"];
		$topic=$ligne["topic"];
		$url=$ligne["url"];
		$alt=$ligne["alt"];
		$anchor = $ligne["anchor"];
		$misc = $ligne["misc"];		
		
		echo '<tr>';
		
		echo '
		<td class="data">'.$link_id.'</td>
		<td class="data">'.$post_id.'</td>
		<td class="data">'.$topic.'</td>
		<td class="data"><a href="'.$tld.'manage/editlink.php?link_id='.$link_id.'">'.$anchor.'</a></td>
		<td class="data">'.$alt.'</td>
		<td class="data">'.$misc.'</td></tr>';

		}
}
echo '</table>';

?>
</div>
<br style="clear:both" />