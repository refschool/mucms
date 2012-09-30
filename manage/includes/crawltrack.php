<?php
//append forward / if neede to ensure crawltrack can show data

if(strpos($post['query_string'],'/') == 0){
	$url = $post['query_string'];
} else {
	$url = '/' . $post['query_string'];
}
?>

<h2>Bot visit statistics for : <?=$url?></h2>

<?php
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
	$crawldata[$k]['datediff']=date_difference(date('Y-m-d h:i:s'), $crawldata[$k]['date']);
	}
	else{
	$crawldata[$k]['datediff']=date_difference($crawldata[$k-1]['date'], $crawldata[$k]['date']);
	}
	
	$crawldata[$k]['crawlt_ip_used'] = $row['crawlt_ip_used'];
	$crawldata[$k]['crawler_name'] = $row['crawler_name'];
	$crawldata[$k]['crawlt_error'] = $row['crawlt_error'];$k++;
}

echo '<table class="collapse"><tr class="header"><td>N°</td><td>Date</td><td>Interval</td><td class="hlabel">Robot</td><td >IP</td><td>Crawl Err</td></tr>';
for($i=0;$i < count($crawldata);$i++){
	echo '<tr>';
	echo '<td>'.$crawldata[$i]['id'].'</td>';
	echo '<td>'.$crawldata[$i]['date'].'</td>';
	if($crawldata[$i]['datediff']['days_total'] > 0){	
	echo '<td>'.$crawldata[$i]['datediff']['days_total'].' j</td>';
} else{
	echo '<td>'.$crawldata[$i]['datediff']['hours_total'].' h</td>';
}
	
	echo '<td>'.$crawldata[$i]['crawler_name'].'</td>';
	echo '<td>'.$crawldata[$i]['crawlt_ip_used'].'</td>';
	echo '<td>'.$crawldata[$i]['crawlt_error'].'</td>';	
	echo '</tr>';

}
echo '</table>';
?>