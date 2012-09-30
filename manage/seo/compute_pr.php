<?php session_start();
include("../../inc/config.php");include("../class/manager.class.php");include("seofunctions.php");include("pr.class.php");
$url_group = $_GET['url_group'];

	
	$urls = get_urls('all');

	$url_pr = compute_pagerank($urls);
	
	/*
	echo '<pre>';	
	print_r($url_pr);
	echo '</pre>';
	*/
	
	//write to `seo_urls` table
	
	//delete current record
	$sql_delete = "delete from `$tprefix"."_seo_urls`";echo $sql_delete ;
	$db->query($sql_delete);
	
	
	//insert into table `seo_urls`
	for($i=0;$i<count($url_pr);$i++){
	
		$sql = "insert into `$tprefix"."_seo_urls` (`url`,`pagerank`) values ('".$url_pr[$i]['url']."','".$url_pr[$i]['pagerank']."')";
		$db->query($sql);echo $sql . '<br>';
	
	}
	