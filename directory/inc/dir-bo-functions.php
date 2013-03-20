<?php

/**
 * [remove_accent description]
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function remove_accent($str)
{
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð',
                'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã',
                'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ',
                'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ',
                'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę',
                'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī',
                'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ',
                'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ',
                'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 
                'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 
                'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ',
                'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');

  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O',
                'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c',
                'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u',
                'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D',
                'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g',
                'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K',
                'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o',
                'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S',
                's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W',
                'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i',
                'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
}


/* */
/**
 * Générateur de Slug (Friendly Url) : convertit un titre en une URL conviviale.
 * @param  [type] $str [description]
 * @return [type]      [description]
 */
function slug($str){
  return mb_strtolower(preg_replace(array('/[^a-zA-Z0-9 \'-]/', '/[ -\']+/', '/^-|-$/'),
  array('', '-', ''), remove_accent($str)));
}



/**
 * display the manager version of the current installation
 * @return [type] [description]
 */
function get_directory_version(){
	$filename = '../version.txt';
	$handle = fopen($filename,'r');
	$content = fread($handle,filesize($filename));
	
	fclose($handle);
	
	return $content;

}


/**
 * get the list of categories
 * @param  [type] $entry_id [description]
 * @return [type]           [description]
 */
function get_categories(){
	global $db,$tprefix;
	$sql = "select * from `$tprefix"."_dir_cat` order by `cat_name` asc ";

	$result=$db->query($sql);$k=0;

			while($row = $result->fetch_assoc()){
				$cat[$k]['cat_id'] = $row['cat_id'];
				$cat[$k]['cat_name'] = $row['cat_name'];				
				
			$k++;
			}

		if(empty($cat)){
			return FALSE;
		}
		else {
			return $cat;
		}


}


/**
 * pour l'instant on fait une seule catégorie par entrée
 * TODO : multicategory
 * @param  [type] $entry_id [description]
 * @return [type]           [description]
 */
function get_entry_category($entry_id){
	global $db,$tprefix;
	$sql = "select * from `$tprefix"."_dir_entry` E INNER JOIN `$tprefix"."_dir_cat` C on E.cat_id = C.dir_cat_id where `entry_id` = '$entry_id' ";

	echo $sql;

	$result=$db->query($sql);
			while($row = $result->fetch_assoc()){
				$cat['cat_id'] = $row['cat_id'];
				$cat['cat_name'] = $row['cat_name'];				
				$cat['parent_id'] = $row['parent_id'];
				
			}


		if(empty($cat)){
			return FALSE;
		}
		else {
			return $cat;
		}


}


/**
 * [get_dir_entries description]
 * @return [type] [description]
 */
function get_dir_entries(){
	global $db,$tprefix;
	$sql = "select * from `$tprefix"."_dir_entry` E INNER JOIN `$tprefix"."_dir_cat` C on E.cat_id = C.cat_id  LEFT JOIN `$tprefix"."_meta` M ON M.meta_id = E.meta_id order by E.entry_id desc limit 100";

	//echo $sql;
	$result=$db->query($sql);$k=0;
			while($row = $result->fetch_assoc()){
				$entry[$k]['entry_id'] = $row['entry_id'];
				$entry[$k]['cat_id'] = $row['cat_id'];
				$entry[$k]['meta_id'] = $row['meta_id'];	
				$entry[$k]['path'] = $row['path'];			
				$entry[$k]['website_name'] = $row['website_name']; 
				$entry[$k]['website_url'] = $row['website_url'];  
				$entry[$k]['email'] = $row['email'];  
				$entry[$k]['datetime'] = $row['datetime']; 
				$entry[$k]['timestamp'] = $row['timestamp']; 

				$k++;
			}


		if(empty($entry)){
			return FALSE;
		}
		else {
			return $entry;
		}



}

/**
 * [get_entry description]
 * @param  [type] $entry_id [description]
 * @return [type]           [description]
 */
function get_entry($entry_id){
	global $db,$tprefix;
	$sql = "select * from `$tprefix"."_dir_entry` E INNER JOIN `$tprefix"."_dir_cat` C ON E.cat_id=C.cat_id where `entry_id` = '$entry_id'";

	//echo $sql;
	$result=$db->query($sql);
			while($row = $result->fetch_assoc()){
				$entry['entry_id'] = $row['entry_id'];
				$entry['cat_id'] = $row['cat_id'];
				$entry['meta_id'] = $row['meta_id'];				
				$entry['website_name'] = $row['website_name']; 
				$entry['website_url'] = $row['website_url'];  
				$entry['email'] = $row['email'];  
				$entry['short_desc'] = $row['short_desc'];  
				$entry['long_desc'] = $row['long_desc'];  

				$entry['street'] = $row['street'];  
				$entry['street2'] = $row['street2'];  
				$entry['postcode'] = $row['postcode'];  
				$entry['city'] = $row['city'];  
				$entry['country'] = $row['country']; 
				$entry['phone'] = $row['phone']; 

				$entry['twitter'] = $row['twitter']; 
				$entry['facebook'] = $row['facebook']; 
				$entry['status'] = $row['status'];
				$entry['backlink_page'] = $row['backlink_page']; 


				$entry['datetime'] = $row['datetime'];  
				
			}


		if(empty($entry)){
			return FALSE;
		}
		else {
			return $entry;
		}

}