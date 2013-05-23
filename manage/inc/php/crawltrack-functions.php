<?php

/**
 * read the DB and retrieve the occurence of a bot crawling in this case Google
 * @return [type] [description]
 */
function get_googlebot_crawls($url){
	global $db;


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
	desc";
	//echo $sql;


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


	if(!empty($crawldata)){ 
		return $crawldata;
	}
	else 
	{ 
		return FALSE;
	}

}



/**
 * [get_google_referal description]
 * show the keyword for natural trafic
 * @param  [type] $url [description]
 * @param  [type] $now [description]
 * @return [type]      [description]
 */
function get_google_referal($url,$start,$end){
	global $db;

	$sql = "SELECT `date`,CK.id_keyword,CK.keyword
	FROM `crawlt_visits_human` CVH
	INNER JOIN `crawlt_keyword` CK ON CK.id_keyword = CVH.crawlt_keyword_id_keyword
	INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
	WHERE `url_page` = '$url'
	AND `date`
	BETWEEN '$start'
	AND '$end'
	order by  `date` desc";
	//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw[$k]['date'] =  $row['date'];
		$kw[$k]['keyword'] = utf8_decode($row['keyword']);
		$kw[$k]['id_keyword'] = $row['id_keyword'];
	$k++;
	}

	if(!empty($kw)){ 
		return $kw;
	}
	else 
	{ 
		return FALSE;
	}
}





function date_difference($date1, $date2){

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

/**
 * return occurence of a keyword along date
 * @param  [type] $keyword_id [description]
 * @param  [type] $start      [description]
 * @param  [type] $end        [description]
 * @return [type]             [description]
 */
function get_keyword_hit_by_day($keyword_id,$start,$end){
	global $db;

	$sql = "SELECT count( id_visit ) C, date( date ) D
FROM `crawlt_visits_human` CVH
INNER JOIN crawlt_keyword CK ON CK.id_keyword = CVH.crawlt_keyword_id_keyword
WHERE `crawlt_keyword_id_keyword` = '$keyword_id' 
GROUP BY D
HAVING D between '$start' and '$end'
LIMIT 0 , 30";

//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw_hit[$k]['count'] =  $row['C'];
		$kw_hit[$k]['day'] = $row['D'];
	$k++;
	}

	if(!empty($kw_hit)){ 
		return $kw_hit;
	}
	else 
	{ 
		return FALSE;
	}

}


function get_keyword_count_by_date_range($start,$end){
	global $db;

	$sql = "SELECT count(`crawlt_keyword_id_keyword`) AS C,CK.keyword FROM `crawlt_visits_human` CVH INNER JOIN `crawlt_keyword` CK ON CVH.crawlt_keyword_id_keyword = CK.id_keyword WHERE `date` between '$start' AND '$end' group by CK.keyword  order by C DESC";

	//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw_count[$k]['count'] =  $row['C'];
		$kw_count[$k]['keyword'] = $row['keyword'];
	$k++;
	}

	if(!empty($kw_count)){ 
		return $kw_count;
	}
	else 
	{ 
		return FALSE;
	}

}

/**
 * refer to SQL 6
 * will get the number of keyword occurence by page
 * will display one column for keyword and one column for landing page url
 * @param  [type] $start [description]
 * @param  [type] $end   [description]
 * @return [type]        [description]
 */
function get_nb_kw_by_page($start,$end){
	global $db;
	$sql = "SELECT count(CK.keyword) AS C, CK.keyword,CK.id_keyword, CP.url_page,CP.id_page FROM `crawlt_visits_human` CVH 
INNER JOIN `crawlt_keyword` CK 
ON CK.id_keyword = CVH.crawlt_keyword_id_keyword
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `date`
BETWEEN '$start'
AND '$end'
GROUP BY CK.keyword
ORDER BY CP.url_page,C DESC";

	//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw_count[$k]['count'] =  $row['C'];
		$kw_count[$k]['id_keyword'] =  $row['id_keyword'];
		$kw_count[$k]['keyword'] = $row['keyword'];
		$kw_count[$k]['url_page'] = $row['url_page'];
		$kw_count[$k]['id_page'] = $row['id_page'];
	$k++;
	}

	if(!empty($kw_count)){ 
		return $kw_count;
	}
	else 
	{ 
		return FALSE;
	}

}

/**
 * get the different keyword to a page
 * @param  [type] $id_page [description]
 * @param  [type] $start   [description]
 * @param  [type] $end     [description]
 * @return [type]          [description]
 */
function get_page_kw_distribution($id_page,$start,$end){
	global $db;
	$sql="SELECT count(CK.keyword) AS C, CK.id_keyword,CK.keyword, CP.url_page, CP.id_page FROM `crawlt_visits_human` CVH 
INNER JOIN `crawlt_keyword` CK 
ON CK.id_keyword = CVH.crawlt_keyword_id_keyword
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `date`
BETWEEN '$start'
AND '$end'
AND CP.id_page = '$id_page'
GROUP BY CK.keyword
ORDER BY C DESC";

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$kw_distribution[$k]['count'] =  $row['C'];
		$kw_distribution[$k]['id_keyword'] =  $row['id_keyword'];
		$kw_distribution[$k]['keyword'] = $row['keyword'];
		$kw_distribution[$k]['url_page'] = $row['url_page'];
		$kw_distribution[$k]['id_page'] = $row['id_page'];
	$k++;
	}

	if(!empty($kw_distribution)){ 
		return $kw_distribution;
	}
	else 
	{ 
		return FALSE;
	}

}

/**
 * Refer to SQL 3
 * get evolution of a keyword along a period
 * in this function it is by month
 * >> used in hit-by-page-evolution.php
 * @param  [type] $id_keyword [description]
 * @param  [type] $start      [description]
 * @param  [type] $end        [description]
 * @return [type]             [description]
 */
function get_page_hit_evolution($id_page,$start,$end){
	global $db;
	$sql="SELECT count( `crawlt_id_page` ) C, MONTHNAME(`date`) MN ,YEAR(`date`) YR, CP.url_page
FROM `crawlt_visits_human` CVH
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `date`
BETWEEN '$start'
AND '$end'AND CP.id_page='$id_page'
GROUP BY YEAR(`date`),MONTH(`date`)
ORDER BY `date` DESC";

//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$page_hit[$k]['count'] =  $row['C'];
		$page_hit[$k]['url_page'] = $row['url_page'];
		$page_hit[$k]['id_page'] = $row['id_page'];
		$page_hit[$k]['month'] = $row['MN'];
		$page_hit[$k]['year'] = $row['YR'];				
	$k++;
	}

	if(!empty($page_hit)){ 
		return $page_hit;
	}
	else 
	{ 
		return FALSE;
	}	
}

/**
 * refer to SQL1
 * get the hits by page for a date range (for all pages)
 * >> used in hit-by-page.php
 * @param  [type] $start [description]
 * @param  [type] $end   [description]
 * @return [type]        [description]
 */
function get_pages_traffic_sitewide($start,$end){

	global $db;
	$sql="SELECT count( `crawlt_id_page` ) C, `date` , CP.url_page, CP.id_page
FROM `crawlt_visits_human` CVH
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `date`
BETWEEN '$start'
AND '$end'
GROUP BY CP.url_page
ORDER BY C DESC";

//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$page_hit[$k]['count'] =  $row['C'];
		$page_hit[$k]['url_page'] = $row['url_page'];
		$page_hit[$k]['id_page'] = $row['id_page'];
			
	$k++;
	}

	if(!empty($page_hit)){ 
		return $page_hit;
	}
	else 
	{ 
		return FALSE;
	}


}


/**
 * refer to SQL 2
 * get the hits by page for a date range for one page
 * >> used in hit-by-page-evolution.php
 * @param  [type] $start [description]
 * @param  [type] $end   [description]
 * @return [type]        [description]
 */
function get_pages_traffic_evolution($id_page,$start,$end){

	global $db;
	$sql="SELECT count( `crawlt_id_page` ) C, LEFT( `date` , 7 ) D, CP.url_page
FROM `crawlt_visits_human` CVH
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
WHERE `date`
between '$start' and '$end'
AND CP.id_page = '$id_page'
GROUP BY D
ORDER BY D DESC";

//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$page_hit[$k]['count'] =  $row['C'];
		$page_hit[$k]['url_page'] = $row['url_page'];
		$page_hit[$k]['month'] = $row['D'];
			
	$k++;
	}

	if(!empty($page_hit)){ 
		return $page_hit;
	}
	else 
	{ 
		return FALSE;
	}


}



/**
 * as per SQL 4
 * @param  [type] $id_keyword [description]
 * @param  [type] $_id_page   [description]
 * @param  [type] $start      [description]
 * @param  [type] $end        [description]
 * @return [type]             [description]
 */
function get_keyword_evolution($id_keyword,$id_page,$start,$end){
	global $db;
	$sql="SELECT count(`crawlt_id_page`) C, CP.url_page, CK.keyword, MONTHNAME(`date`) MN , YEAR(`date`) YR
FROM `crawlt_visits_human` CVH 
INNER JOIN `crawlt_pages` CP ON CP.id_page = CVH.crawlt_id_page
INNER JOIN `crawlt_keyword` CK ON CK.id_keyword = CVH.`crawlt_keyword_id_keyword`
WHERE  `date`
BETWEEN '$start'
AND '$end' 
AND CP.id_page = '$id_page'
AND `crawlt_keyword_id_keyword` = '$id_keyword'
GROUP BY YEAR(`date`),MONTH(`date`)
ORDER BY `date` DESC";

//echo $sql;

	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$page_hit[$k]['count'] =  $row['C'];
		$page_hit[$k]['keyword'] = $row['keyword'];
		$page_hit[$k]['month'] = $row['MN'];
		$page_hit[$k]['year'] = $row['YR'];	
	$k++;
	}

	if(!empty($page_hit)){ 
		return $page_hit;
	}
	else 
	{ 
		return FALSE;
	}



}