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

				if($_POST['end'] == ''){
					$_POST['end'] = date('Y-m-d');
				} 
				
				if($_POST['start'] == ''){
					$_POST['start'] = date('Y-m-d',strtotime('- 1 month')) ;
				}

$kw = get_google_referal($url,$_POST['start'],$_POST['end']);

//display keyword
for($i=0;$i < count($kw);$i++){
	echo $kw[$i]['date']. ' :: ' . $kw[$i]['keyword'] . '<br>';


}