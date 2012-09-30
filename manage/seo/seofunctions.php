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
	global $db;global $tprefix;global $tld;

	switch($group){
	case 'all':
		//query all the urls of table content
		$sql  = "select * from `$tprefix"."_content` where `published` = 'Y'";//echo $sql;
		$result = $db->query($sql); 
		if($result){
			while($row = $result->fetch_assoc()){
				$urls[] = $row['thisurl'];
			}
		}		
		
		//query all urls from table links
		$sql2 = "select * from `$tprefix"."_links` where `topic` IN ('category','tag')";//echo $sql2;
		$result2 = $db->query($sql2); 
		if($result2){
			while($row2 = $result2->fetch_assoc()){
				$urls2[] = $row2['url'];
			}
		}
		//add tld at top of array
		array_unshift($urls,$tld);
		$urls = array_merge($urls,$urls2);
		
		
		break;
		
		
	case 'category':
		//query category urls from links table
		break;
		
	case 'tag':
		//query  tag urls from links table
		break;
		}
		
		
		
	return $urls;
}


function get_pagerank($url){

}