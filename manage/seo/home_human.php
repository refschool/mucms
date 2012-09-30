<h2>Keyword statistics for this page :</h2>

<?php
$url = '/';

$now = date('Y-m-d H:i:s');

$sql = "SELECT `date`,CK.keyword
FROM `crawlt_visits_human` CVH
INNER JOIN `crawlt_keyword` CK ON CK.id_keyword = CVH.crawlt_keyword_id_keyword
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `url_page` = '$url'
AND `date`
BETWEEN '2011-08-01 00:0:00'
AND '$now'
order by  `date` desc";//echo $sql;

$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw[$k]['date'] =  $row['date'];
		$kw[$k]['keyword'] = utf8_decode($row['keyword']);
	$k++;
}

//display keyword
for($i=0;$i < count($kw);$i++){
	echo $kw[$i]['date']. ' :: ' . $kw[$i]['keyword'] . '<br>';


}