<h2>Keyword statistics for this page :</h2>

<?php
$url = '/';

$now = date('Y-m-d H:i:s');

$kw = get_google_referal('/','2012-12-31',date('Y-m-d H:i:s'));

//display keyword
for($i=0;$i < count($kw);$i++){
	echo $kw[$i]['date']. ' :: <a href="'.$tld.'manage/seo/stat.php?kw_id='.$kw[$i]['id_keyword'].'">' . $kw[$i]['keyword'] . '</a><br>';


}