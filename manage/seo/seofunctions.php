<?php



function compute_pagerank($urls){
	
	$p = new pagerankChecker();

			for($i=0;$i<count($urls);$i++){
				$pagerank[$i] = $p->getpr($urls[$i]);
				if(isset($pagerank))
				{} 
				else 
				{$pagerank = '-';}
			
			$url_pr[$i]['url']= $urls[$i];
			$url_pr[$i]['pagerank']= $pagerank[$i];
			
			}
			
	return $url_pr;
	
}


//fetch urls with pagerank and so...
function get_seo_urls(){
	global $db;global $tprefix;
	$sql = "select * from `".$tprefix."_seo_urls`";//echo $sql;
	$result = $db->query($sql);$k=0;
	while($row = $result->fetch_assoc()){
		$urls[$k]['url_id'] = $row['url_id'];
		$urls[$k]['url'] = $row['url'];
		$urls[$k]['pagerank'] = $row['pagerank'];
		$urls[$k]['nb_inlinks'] = $row['nb_inlinks'];
		$urls[$k]['nb_outlinks'] = $row['nb_outlinks'];
		$urls[$k]['datetime'] = $row['datetime'];
		$urls[$k]['timestamp'] = $row['timestamp'];
		$k++;
	}
	
	if(!empty($urls)){
		return $urls;
	} else {
		return FALSE;
	}
}

//fetch get urls from tables : links, content to compute
function get_urls($group){
	global $db,$tprefix,$tld;

	switch($group){
	case 'all':
		//query all the urls of table content
		$sql  = "select `path` from `$tprefix"."_meta` ";
		echo $sql;
		$result = $db->query($sql); 
		if($result){
			while($row = $result->fetch_assoc()){
				$urls[] = $row['path'];
			}
		}		
		

		}
		
		
		
	return $urls;
}


function get_pagerank($url){

}