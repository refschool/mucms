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

$crawldata = get_googlebot_crawls($url);


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