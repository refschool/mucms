<?php

include("debug-functions.php");
include("hook-functions.php");
include("comment_functions.php");
include("tag-category-functions.php");

function pretty($array){
	echo '<pre>';
	print_r($array);
	echo '</pre>';
}

//recursive ksort
function deep_ksort(&$arr) {
    ksort($arr);
    foreach ($arr as &$a) {
        if (is_array($a) && !empty($a)) {
            deep_ksort($a);
        }
    }
} 

//redirect function
function get_redirect_code($path){
	global $tprefix,$tld,$db;
	$sql = "select `redirect_type` from `$tprefix"."_meta` where `path` = '$path'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	if(empty($row)){
		return FALSE;
	}
	else {
		return $row['redirect_type'];
	}
}


//redirect function
function is_active_redirect($path){
	global $tprefix,$tld,$db;
	$sql = "select `redirect` from `$tprefix"."_meta` where `path` = '$path'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	
	if(empty($row)){
		return FALSE;
	}
	else {
		return $row['redirect'];
	}
}

/**
 * 
 * todo make a global object to pass as argument and prevent global
 * get meta type home,category,etc,post
 * */
function get_meta_type($path){
	global $tprefix; global $tld;global $db;
	$sql = "select `type` from `$tprefix"."_meta` where `path` = '$path'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	if(empty($row)){
		return FALSE;
	}
	else {
	return $row['type'];
	}
	
}

///  GET META

function get_title(){
	global $content;
	if(isset($content['title'])){
	echo $content['title'];
}
}

function get_description($content_type){
	global $content;
	if(isset($content['description'])){
		echo $content['description'];
	}
}

function get_keyword($content_type){
	global $content;
	if(isset($content['keyword'])){
		echo $content['keyword'];
	}
}



/*******************/

//get post
function get_single_post($path){
	global $tprefix; global $tld;global $db;
	$sql = "select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_meta` M ON C.meta_id = M.meta_id where M.path = '$path' ";//echo $sql;
	$result=$db->query($sql);
	if($result){
		while($row = $result->fetch_assoc()){
			$p['id'] = $row['id'];
			$p['meta_id'] = $row['id']; 
			$p['title'] = $row['title'];  
			$p['h1_title'] = $row['h1_title'];	
			$p['author'] = $row['author'];
			$p['date_posted'] = $row['date_posted'];		
			$p['social_body_text'] = $row['social_body_text'];		
			$p['main_text'] = $row['main_text'];
			$p['lang'] = $row['lang'];	
			$p['readmore'] = $row['readmore'];
			$p['com_closed'] = $row['com_closed'];		
			
			$p['path'] = $row['path'];
			$p['redirect'] = $row['redirect'];
			$p['redirect_type'] = $row['redirect_type']; 
			$p['meta_robot_index '] = $row['meta_robot_index'];
			$p['meta_robot_follow'] = $row['meta_robot_follow']; 		
			$p['meta_robot_archive'] = $row['meta_robot_archive'];
			$p['meta_robot_snippet'] = $row['meta_robot_snippet']; 
			$p['meta_canonical'] = $row['meta_canonical'];
			$p['meta_robot_odp '] = $row['meta_robot_odp']; 	
			$p['meta_robot_ydir'] = $row['meta_robot_ydir'];
			$p['meta_googlebot '] = $row['meta_googlebot']; 
			$p['description'] = $row['description'];
			$p['keyword'] = $row['keyword']; 	
				//$p['post'] = $row['post']; 
		}	
		
		if(empty($p)){
			return FALSE;
		}
		else {
			return $p;
		}
		
	}	
	
}


//fetch header meta may not be kept
function fetch_meta($currpath){
	global $tprefix; global $tld;global $db;
	$sql = "select * from `$tprefix"."_meta` where `path` = '$currpath'";//echo $sql;
	$result = $db->query($sql);
	while($row = $result->fetch_assoc()){
		$meta['meta_id'] = $row['meta_id'];
		$meta['path'] = $row['path'];
		$meta['meta_robot_index'] = $row['meta_robot_index'];
		$meta['meta_robot_follow'] = $row['meta_robot_follow'];
		$meta['meta_robot_archive'] = $row['meta_robot_archive'];
		$meta['meta_robot_snippet'] = $row['meta_robot_snippet'];
		$meta['meta_canonical'] = $row['meta_canonical'];
		$meta['meta_robot_odp'] = $row['meta_robot_odp'];
		$meta['meta_robot_ydir'] = $row['meta_robot_ydir'];
		$meta['meta_googlebot '] = $row['meta_googlebot'];
		$meta['rss_desc'] = $row['rss_desc'];
		$meta['type'] = $row['type'];
	}
	
	return $meta;

}
//get a php include as a string !important
function get_include_contents($filename) {
    if (is_file($filename)) {
        ob_start();
        include $filename;
        return ob_get_clean();
    }
    return false;
}



//get related TO REWRITE
function get_related_posts($post_id){
	global $tprefix,$tld,$db;

		//read links table and retrieve id, url, alt, anchor
		//put into an array
		
		$sql = "select `misc`,`url`,`alt`,`anchor` from `$tprefix"."_links` where `topic` = 'related' and `post_id` = '$post_id' order by `misc` asc"; //echo $sql;

		$result = $db->query($sql);$k=0;
		if($result){
			while($row = $result->fetch_assoc()){
				$related[$k]['id'] = $row['id'];
				$related[$k]['url'] = $row['url'];
				$related[$k]['alt'] = $row['alt'];
				$related[$k]['anchor'] = $row['anchor'];
				$k++;
						}
				}
		
		return $related;		
		}
		
//get_post_id from sefurl
function get_post_id($sefurl){
	global $tprefix; global $tld;global $db;
	$sql = "select `id` from `$tprefix"."_content` where `sefurl` = '$sefurl'";//echo $sql;
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	return $post_id = $row['id'];


}




//show the horizontal menu at top of page
//this function does not exist and not useful anymore
/*function get_menu (){
	?>
	<div id="menu">
		<ul>
	<?php
			for($i=0;$i<count($m);$i++){  ?>
			<li>
				<a href="<?=$m[$i]['url']?>" >
					<?=$m[$i]['anchor']?>
				</a>
			</li>
	<?php
	}  //end for loop
	?>
		</ul>
	</div>

	
	<?php
	
}*/
//get nth latest posts
function get_latest_post($nb_post){
			global $tprefix,$tld,$db;

$latest = array();

			$sql = "select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_meta` M ON M.meta_id = C.meta_id where C.published='Y' order by C.date_posted desc limit $nb_post";//echo $sql;
			$result = $db->query($sql);$k=0;
			while($row=$result->fetch_assoc()){
				$latest[$k]['post_id']=$row['id'];
				$latest[$k]['title']=$row['title'];
				$latest[$k]['social_body_text']=$row['social_body_text'];
				$latest[$k]['readmore']=$row['readmore'];
				$latest[$k]['lang']=$row['lang'];
				$latest[$k]['date_posted']=$row['date_posted'];
				
				$latest[$k]['path']=$row['path'];
				
			$k++;
			}
		return $latest;
	
	}

function get_posts ($start,$number,$type,$cat = '') {
	global $tprefix; global $db;


	$sql="select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_meta` M ON M.meta_id = C.meta_id where `published` = 'Y' order by `date_posted` desc limit $start,$number";

	
	//echo $sql;
	$result = $db->query($sql);$k = 0;

	if($result){
	while($row = $result->fetch_assoc()){

	$output[$k]['id'] = $row['id'];	
	$output[$k]['title'] = ucwords($row['title']);	
	$output[$k]['h1_title'] = $row['h1_title'];	
	$output[$k]['author'] = ucwords($row['author']);	
	$output[$k]['social_body_text'] = $row['social_body_text'];	
	$output[$k]['date_posted'] = $row['date_posted'];	
	$output[$k]['main_text'] = $row['main_text'];	
	$output[$k]['lang'] = $row['lang'];	
	$output[$k]['readmore'] = $row['readmore'];		
	
	$output[$k]['description'] = $row['description'];	
	$output[$k]['keyword'] = $row['keyword'];	
	$output[$k]['thisurl'] = $row['path'];	
					
	$k++;
		}

	return $output;	
	}
	
}


	
function get_footer(){
		
		?>
		
		<div id="footer">
		<div class="subfooter">
			<ul>
				<li><a href="#">Sample footer</a></li>
			</ul>
	</div>
	<br style="clear:both" />
</div>
<?php
}



function get_meta_robots(){
	global $content_type;global $tld2;
	
/* SE meta directives TO REWRITE OR DUMP*/
if($content_type=='thepost'){

	$currpath = $tld2 . $_SERVER['REQUEST_URI'];
	
	//function fetch meta
	//fetch meta data on table based on currpath
	$meta = fetch_meta($currpath);


	if($meta['meta_canonical']=='checked'){
	echo '<link rel="canonical" href="'.$meta['path'].'" />';
	}


	if($meta['meta_robot_index']=='checked'){
	echo '<meta name="robots" content="noindex" />';
	}

	if($meta['meta_robot_follow']=='checked'){
	echo '<meta name="robots" content="nofollow" />';
	}

	if($meta['meta_robot_archive']=='checked'){
	echo '<meta name="robots" content="noarchive" />';
	}

	if($meta['meta_robot_snippet']=='checked'){
	echo '<meta name="robots" content="nosnippet" />';
	}

	if($meta['meta_robot_odp']=='checked'){
	echo '<meta name="robots" content="noodp" />';
	}

	if($meta['meta_robot_ydir']=='checked'){
	echo '<meta name="robots" content="noydir" />';
	}

}


}

function get_verification($verify_hash){
	global $content_type;
	
	if($content_type == 'index'){
		/*display SE directives*/
		foreach($verify_hash AS $se => $hash){
			if ($se=='google') {
			echo '<meta name="google-site-verification" content="'.$hash.'" />';	
			}
			if ($se=='bing') {
				echo '<meta name="msvalidate.01" content="'.$hash.'" />';
			} 

			if($se=='yahoo'){  
				echo '<meta name="y_key" content="'.$hash.'" />';
			}

		}

	}
}


