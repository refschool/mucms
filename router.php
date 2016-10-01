<?php

//parse query string
$path = 'http://' . $_SERVER['HTTP_HOST'] . ($_SERVER['REQUEST_URI']); 
//dispatch the page according to the type of content
//if directory then set content_type = 'directory'

$meta_type = get_meta_type($path);
$content = array();


//guess from the type in the meta table what type of content we want

//cast 404 if no entry found


if(!$meta_type){
				//send 404 header first
				header("HTTP/1.0 404 Not Found");
				//then cast the content for 404 page
				$content['type'] = 'error404';
}

//check if a redirect is active
// for redirect protocol see http://www.w3.org/Protocols/rfc2616/rfc2616-sec10.html
$redirect = is_active_redirect($path);
$redirect_type = get_redirect_code($path);

if($redirect){
	if($redirect_type == 301){
	header("HTTP/1.1 301 Moved Permanently" );
	header("Location: $redirect");
	}
	
	if($redirect_type == 302){
	header("HTTP/1.1 302 Found" );
	header("Location: $redirect");
	}	
}


//home page
if($meta_type == 'home'){

		//homepage
		$content['type'] = 'index';
		$content['title'] = $home_title;
		$content['description'] = $home_description;
		$content['keyword'] = $home_keyword;
			
		$p = get_posts(0,$home_post_nb,'');
		
			for($i=0;$i<count($p);$i++){
				$content['page_element'][$i]['sub_title'] = $p[$i]['title'];
				$content['page_element'][$i]['thisurl']= $p[$i]['thisurl'];
				$content['page_element'][$i]['social_body_text']=$p[$i]['social_body_text'];
				$content['page_element'][$i]['readmore']=$p[$i]['readmore'];
				$content['page_element'][$i]['main_text']=$p[$i]['main_text'];
				$content['page_element'][$i]['id'] = $p[$i]['id'];
				$content['page_element'][$i]['date_posted'] = $p[$i]['date_posted'];

			}

			

	}

//post page
	//loop throught database to see if first parameter is a category of the site
	if($meta_type == 'post'){
			//post
			$p = get_single_post($path);

		
			if(!$p){
				//send 404 header first
				header("HTTP/1.0 404 Not Found");
				//then cast the content for 404 page
				$content['type'] = 'error404';
			}		
			else
			{
				$content['type'] = 'thepost';
				$content['title'] = $p['title'];
				$content['description'] = $p['description'];
				$content['keyword'] = $p['keyword'];

				$post_id = $p['id'];
				$content['page_element'][0]['sub_title'] = $p['h1_title'];
				$content['page_element'][0]['thisurl']= $p['path'];
				$content['page_element'][0]['description']=$p['description'];
				$content['page_element'][0]['readmore']=$p['readmore'];
				$content['page_element'][0]['main_text']=$p['main_text'];
				$content['page_element'][0]['id'] = $p['id'];
				$content['page_element'][0]['com_closed'] = $p['com_closed'];
				$content['page_element'][0]['date_posted'] = $p['date_posted'];					
				
				
				
			}
	
	}


	
//category page
	if($meta_type == 'category'){

		//select post belonging to the category and test if there is result
		
		//get the cat_id (one result)
		$sql = "select C.cat_id,C.cat_label from `$tprefix"."_category` C INNER JOIN `$tprefix"."_meta` M ON M.meta_id = C.meta_id where M.path = '$path'";//echo $sql;
		$result = $db->query($sql);
		$row = $result->fetch_assoc(); $cat_id = $row['cat_id'];$cat_label = $row['cat_label'];
		
		//echo 'cat_id '.$cat_id;
		
		//get the path of the posts that have the cat_id
		$sql = "select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_cat_post` CP ON CP.post_id = C.id INNER JOIN `$tprefix"."_meta` M  ON C.meta_id = M.meta_id where CP.cat_id = '$cat_id'";//echo $sql;
		$result = $db->query($sql);


		//echo '<pre>';print_r($row);echo '</pre>';
		
			$i=0;
			$content['type'] = 'thecategory';
			$content['title'] = 'Résultats pour la catégorie '.$cat_label;
			$content['description'] = 'Résultats pour la catégorie '.$cat_label;
			$content['keyword'] = $cat_label;
			
			//put the post of the cateogry in the array
			while($row = $result->fetch_assoc()){
				$content['page_element'][$i]['sub_title'] = $row['title'];
				$content['page_element'][$i]['path']= $row['path'];
				$content['page_element'][$i]['description']=$row['social_body_text'];
				$content['page_element'][$i]['readmore']=$row['readmore'];
				$content['page_element'][$i]['author'] = $row['author'];
				$content['page_element'][$i]['date_posted'] = $row['date_posted'];
			$i++;
			}		
			

	}

//tag page
	if($meta_type == 'tag'){
		

		//select post belonging to the category and test if there is result
		
		//get the cat_id (one result)
		$sql = "select C.tag_id,C.tag_label from `$tprefix"."_tags` C INNER JOIN `$tprefix"."_meta` M ON M.meta_id = C.meta_id where M.path = '$path'";//echo $sql;
		$result = $db->query($sql);
		$row = $result->fetch_assoc(); $tag_id = $row['tag_id'];$tag_label=$row['tag_label'];
		
		//echo 'cat_id '.$cat_id;
		
		//get the path of the posts that have the cat_id
		$sql = "select * from `$tprefix"."_content` C INNER JOIN `$tprefix"."_tag_post` TP ON TP.post_id = C.id INNER JOIN `$tprefix"."_meta` M  ON C.meta_id = M.meta_id where TP.tag_id = '$tag_id'";//echo $sql;
		$result = $db->query($sql);
		
		
		
			$i=0;
			$content['type'] = 'thetag';
			$content['title'] = 'Résultats pour le tag '.$tag_label;			
			$content['description'] = 'Résultats pour le tag '.$tag_label;
			$content['keyword'] = $tag_label;
			
			while($row = $result->fetch_assoc()){
				$content['page_element'][$i]['sub_title'] = $row['title'];
				$content['page_element'][$i]['path']= $row['path'];
				$content['page_element'][$i]['description']=$row['social_body_text'];
				$content['page_element'][$i]['readmore']=$row['readmore'];
				$content['page_element'][$i]['author'] = $row['author'];
				$content['page_element'][$i]['date_posted'] = $row['date_posted'];
			$i++;
			}

	
	}



//home page
if($meta_type == 'directory-home'){

		//homepage
		$content['type'] = $meta_type;
		$content['title'] = $home_title;
		$content['description'] = $home_description;
		$content['keyword'] = $home_keyword;
			
		//get latest entries of directories
		$sql = "select * from `$tprefix"."_dir_entry` E INNER JOIN `$tprefix"."_meta` M ON M.meta_id = E.meta_id where E.status = 'approved' order by `datetime` desc limit 10 ";
		//echo $sql;
		$result = $db->query($sql);  $k = 0;
		while($row = $result->fetch_assoc()){
			$content['page_element'][$k]['website_name'] = $row['website_name'];
			$content['page_element'][$k]['website_url'] = $row['website_url'];
			$content['page_element'][$k]['path'] = $row['path'];
			$content['page_element'][$k]['short_desc'] = $row['short_desc'];
			$k++;
		}
		

			

	}



//directory	
	if($meta_type == 'directory'){

		//get the path of the posts that have the cat_id
		$sql = "select * from `$tprefix"."_dir_entry` E INNER JOIN `$tprefix"."_meta` M ON M.meta_id = E.meta_id  where `path` = '$path' ";
		//echo $sql;
		$result = $db->query($sql);
		
		
			$content['type'] = 'directory';

	
			while($row = $result->fetch_assoc()){
				$content['page_element']['website_name'] = $row['website_name'];
				$content['page_element']['website_url'] = $row['website_url'];
				$content['page_element']['path']= $row['path'];
				$content['page_element']['long_desc']=$row['long_desc'];
				$content['page_element']['short_desc']=$row['short_desc'];

				$content['page_element']['street']=$row['street'];
				$content['page_element']['street2']=$row['street2'];
				$content['page_element']['postcode']=$row['postcode'];
				$content['page_element']['city']=$row['city'];
				$content['page_element']['country']=$row['country'];
				$content['page_element']['phone']=$row['phone'];



				$content['page_element']['twitter']=$row['twitter'];
				$content['page_element']['facebook']=$row['facebook'];


				$content['title'] = $row['website_name'];
				$content['description'] = $row['description'];


				$content['status']=$row['status'];


				}

		
if($content['status'] <> 'approved'){
				//send 404 header first
				header("HTTP/1.0 404 Not Found");
				//then cast the content for 404 page
				$content['type'] = 'error404';
		}


	} //end meta_type = directory

