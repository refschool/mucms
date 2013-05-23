<?php session_start();

include("../../inc/config.php");
include("../inc/php/manager-functions.php");

$category = $_GET["cat"];//$sql="";

//by default select all the posts within a range here 50 posts ordered by date//
switch($category){
case "all":
$sql = "select C.id,C.title,C.published,count(COM.comment_id) as COMCOUNT from `$tprefix"."_content` C left outer join `$tprefix"."_comments` COM on C.id = COM.post_id group by C.id order by C.date_posted desc";//echo $sql;
$_SESSION['category'] = 'all';
break;

case "lm10":
$sql = "select C.id,C.title,C.published,count(COM.comment_id) as COMCOUNT from `$tprefix"."_content` C left outer join `$tprefix"."_comments` COM on C.id = COM.post_id group by C.id order by C.last_edited desc limit 10";//echo $sql;
$_SESSION['category'] = 'lm10';
break;

case "lp10":
$sql = "select C.id,C.title,C.published, count(COM.comment_id) as COMCOUNT from `$tprefix"."_content` C left outer join `$tprefix"."_comments` COM on C.id = COM.post_id  where `published` = 'Y' group by C.id order by `date_posted` desc limit 10";
$_SESSION['category'] = 'lp10';
break;

case "lp30":
$sql = "select C.id,C.title,C.published,count(COM.comment_id) as COMCOUNT from `$tprefix"."_content` C left outer join `$tprefix"."_comments` COM on C.id = COM.post_id  where `published` = 'Y' group by C.id order by `date_posted` desc limit 30";
$_SESSION['category'] = 'lp30';;
break;

case "unpub":
$sql = "select * from $tprefix"."_content where `published` = 'N' order by `last_edited`";
$_SESSION['category'] = 'unpub';
break;

default:
$sql = "select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_cat_post` CP ON CP.post_id = C.id INNER JOIN `$tprefix"."_category` CAT ON CAT.cat_id = CP.cat_id WHERE CAT.cat_label = '$category' order by C.date_posted desc limit 30";
$_SESSION['category'] = $category;
}

$content = '';


/*
this script will update the listing of the posts in the brower based on the category chosen
*/


//select the post for a given category


//echo $sql;

$content = '<table class="collapse">';
$content .= '<tr class="header">';
$content .= '<th>ID</th><th width="250">Title</th><th>PreView</th><th>URL</th><th>nb com</th></tr>';


//echo $sql;echo $tprefix;
$result = $db->query($sql);
while($line = $result->fetch_assoc()){
		//content table
 		$id = $line["id"];
		$title=utf8_decode($line["title"]);
		$published = $line["published"];
		$count = $line["COMCOUNT"];

		//display the datas rows of the table		
		$content .=  '<tr class="'.$published.'"><td>'.$id.'</td><td><a href="'.$tld2.'/manage/write.php?id='.$id.'">'.$title.'</a></td><td><a href="javascript:ajax('.$id.');">Preview</a></td><td><a href="'.get_path($id).'" title="'.get_path($id).'">Copy URL</a></td><td>'.$count.'</td></tr>';
		}
		$content .=  '</table>';
echo $content;
?>














