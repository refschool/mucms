<?php
$url = '/';
?>
<h2>Bot visit statistics for Homepage :<?=$url?></h2>


<?php
function dateDifference($date1, $date2){

/**
 * Calculates the differences between two date
 *
 * @param date $date1
 * @param date $date2
 * @return array
 */

//http://fr.php.net/manual/fr/function.strtotime.php
//http://php.net/manual/fr/function.mktime.php

$d1 = (is_string($date1) ? strtotime($date1) : $date1);
$d2 = (is_string($date2) ? strtotime($date2) : $date2);

$diff_secs = abs($d1 - $d2);
$base_year = min(date("Y", $d1), date("Y", $d2));

$diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

return array(
		"years" => abs(substr(date('Ymd', $d1) - date('Ymd', $d2), 0, -4)),
		"months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1,
		"months" => date("n", $diff) - 1,
		"days_total" => floor($diff_secs / (3600 * 24)),
		"days" => date("j", $diff) - 1,

		"hours_total" => floor($diff_secs / 3600),
		"hours" => date("G", $diff),
		"minutes_total" => floor($diff_secs / 60),
		"minutes" => (int) date("i", $diff),
		"seconds_total" => $diff_secs,
		"seconds" => (int) date("s", $diff)

	);

}


$sql = "SELECT `id_visit` , `date` , `crawlt_ip_used` , `crawler_name`,`crawlt_error` 
FROM `crawlt_visits` CV
INNER JOIN `crawlt_pages` CP ON CP.id_page = CV.crawlt_pages_id_page
INNER JOIN `crawlt_crawler` CC ON CC.id_crawler = CV.crawlt_crawler_id_crawler
WHERE CC.id_crawler
IN (
SELECT `id_crawler`
FROM `crawlt_crawler` 
WHERE `crawler_name` LIKE '%google%')  
and CP.url_page = '$url' order by `date`
desc";//echo $sql;

$result = $db->query($sql);$k=0;
while($row = $result->fetch_assoc()){
	$crawldata[$k]['id'] = $k;
	$crawldata[$k]['id_visit'] = $row['id_visit'];
	$crawldata[$k]['date'] = $row['date'];
	//compute dateDifference
	if($k==0){
	$crawldata[$k]['datediff']=dateDifference(date('Y-m-d h:i:s'), $crawldata[$k]['date']);
	}
	else{
	$crawldata[$k]['datediff']=dateDifference($crawldata[$k-1]['date'], $crawldata[$k]['date']);
	}
	
	$crawldata[$k]['crawlt_ip_used'] = $row['crawlt_ip_used'];
	$crawldata[$k]['crawler_name'] = $row['crawler_name'];
	$crawldata[$k]['crawlt_error'] = $row['crawlt_error'];$k++;
}

echo '<table class="collapse"><tr class="header"><td>N°</td><td>Date</td><td>Interval</td><td>Robot</td><td >IP</td><td>Crawl Err</td></tr>';
for($i=0;$i < count($crawldata);$i++){
	echo '<tr>';
	echo '<td class="data">'.$crawldata[$i]['id'].'</td>';
	echo '<td class="data">'.$crawldata[$i]['date'].'</td>';
	if($crawldata[$i]['datediff']['days_total'] > 0){	
	echo '<td class="data">'.$crawldata[$i]['datediff']['days_total'].' j</td>';
} else{
	echo '<td class="data">'.$crawldata[$i]['datediff']['hours_total'].' h</td>';
}
	
	echo '<td class="data">'.$crawldata[$i]['crawler_name'].'</td>';
	echo '<td class="data">'.$crawldata[$i]['crawlt_ip_used'].'</td>';
	echo '<td class="data">'.$crawldata[$i]['crawlt_error'].'</td>';	
	echo '</tr>';

}
echo '</table>';
?>