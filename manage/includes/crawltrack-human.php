<h2>Keyword statistics for this page :</h2>

<?php
if(strpos($post['query_string'],'/') == 0){
	$url = $post['query_string'];
} else {
	$url = '/' . $post['query_string'];
}
echo '<p>'.$url.'</p>';

echo '<p><a href="/manage/write.php?id='.($editid-1).'">Previous Post</a> '.$url.' <a href="/manage/write.php?id='.($editid+1).'">Next Post</a></p>';
$now = date('Y-m-d H:i:s');



$kw = get_google_referal($url,$now);

//display keyword
for($i=0;$i < count($kw);$i++){
	echo $kw[$i]['date']. ' :: ' . $kw[$i]['keyword'] . '<br>';


}
