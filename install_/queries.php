<?php
//7 FO tables and 4 BO tables
/*******************************************************		

					Table creation

*******************************************************/
//create table Category
$sql ="CREATE TABLE `$prefix"."_category` (
  `cat_id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `cat_label` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY  (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$db->query($sql);
echo $sql.'<br>';

//create table Category-post
$sql = "CREATE TABLE `$prefix"."_cat_post` (
  `cat_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$db->query($sql);echo $sql.'<br>';



//Create Table meta
$sql = "
CREATE TABLE `$prefix"."_meta` (
  `meta_id` int(11) NOT NULL auto_increment,
  `query_string` text collate utf8_unicode_ci NOT NULL,
  `path` text collate utf8_unicode_ci NOT NULL,
  `redirect` text collate utf8_unicode_ci NOT NULL,
  `redirect_type` text collate utf8_unicode_ci NOT NULL,
  `meta_robot_index` text collate utf8_unicode_ci,
  `meta_robot_follow` text collate utf8_unicode_ci,
  `meta_robot_archive` text collate utf8_unicode_ci,
  `meta_robot_snippet` text collate utf8_unicode_ci,
  `meta_canonical` text collate utf8_unicode_ci,
  `meta_robot_odp` text collate utf8_unicode_ci,
  `meta_robot_ydir` text collate utf8_unicode_ci,
  `meta_googlebot` text collate utf8_unicode_ci,
  `description` text collate utf8_unicode_ci NOT NULL,
  `keyword` text collate utf8_unicode_ci NOT NULL,
  `type` text collate utf8_unicode_ci,
  PRIMARY KEY  (`meta_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$db->query($sql);echo $sql.'<br>';

//create comment table
$sql = "
CREATE TABLE `$tprefix"."_comments` (
  `comment_id` int(11) NOT NULL auto_increment,
  `post_id` int(11) NOT NULL,
  `name` text character set utf8 collate utf8_unicode_ci,
  `email` text character set utf8 collate utf8_unicode_ci,
  `website` text collate utf8_unicode_ci,
  `comment` text collate utf8_unicode_ci,
  `ip` varchar(15) character set utf8 collate utf8_unicode_ci default NULL,
  `user_agent` text collate utf8_unicode_ci,
  `status` varchar(1) collate utf8_unicode_ci NOT NULL default 'U',
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`comment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$db->query($sql);echo $sql.'<br>';






// create table Content
$sql = "CREATE TABLE `$prefix"."_content` (
  `id` smallint(6) NOT NULL,
  `meta_id` int(11) NOT NULL,
  `title` text character set utf8 collate utf8_unicode_ci,
  `h1_title` text character set utf8 collate utf8_unicode_ci,
  `author` text character set utf8 collate utf8_unicode_ci,
  `date_posted` datetime default NULL,
  `social_body_text` text character set utf8 collate utf8_unicode_ci,
  `main_text` text character set utf8 collate utf8_unicode_ci,
  `lang` varchar(2) character set utf8 collate utf8_unicode_ci default NULL,
  `readmore` text character set utf8 collate utf8_unicode_ci,
  `published` text character set utf8 collate utf8_unicode_ci,
  `com_closed` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `last_edited` timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$db->query($sql);echo $sql.'<br>';

//create table tags
$sql = "CREATE TABLE `$prefix"."_tags` (
  `tag_id` int(11) NOT NULL AUTO_INCREMENT,
  `meta_id` int(11) NOT NULL,
  `tag_label` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`tag_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
";
$db->query($sql);echo $sql.'<br>';

//create table tags-post
$sql = "CREATE TABLE `$prefix"."_tag_post` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;";
$db->query($sql);echo $sql.'<br>';
/*******************************************************		

					DATA INSERTION

*******************************************************/


//insert table category entries

$sql = "INSERT INTO `$prefix"."_category` VALUES (1, 1, 1, 'accueil', '$date');";
$db->query($sql);echo $sql.'<br>';
$sql = "INSERT INTO `$prefix"."_category` VALUES (2, 1, 2, 'uncategorized', '$date');";
$db->query($sql);echo $sql.'<br>';
//insert entry into meta table for the default category
$sql = "insert into `$prefix"."_meta` (`meta_id`,`query_string`,`path`,`meta_canonical`,`type`) VALUES ('2','/category/uncategorized','".$tld."category/uncategorized','checked','category')";echo $sql.'<br>';
$db->query($sql);

//insert table Category-post entries
$sql = "INSERT INTO `$prefix"."_cat_post` VALUES (2, 3);";echo $sql.'<br>';
$db->query($sql);

//insert table content entry
$sql = "INSERT INTO `$prefix"."_content` (
`id`, 
`meta_id`, 
`title`, 
`h1_title`, 
`author`, 
`date_posted`, 
`social_body_text`, 
`main_text`, 
`lang`, 
`readmore`, 
`published`, 
`note`, 
`last_edited`) 
VALUES
(1, 
4, 
'Welcome to MicroCMS !', 
'MicroCMS the native SEO ready CMS!', 
'".$author."', 
'".$date."', 
'MicroCMS is designed for simplicity and loading speed. ', 
'MicroCMS is designed for simplicity and loading speed and SEO.', 
'fr',
'Discover why now',
'Y', 
'Record your modification here',
'".$date."');";	echo $sql.'<br>';
$db->query($sql);



//insert home meta also beware of index !!
$sql = "INSERT INTO `$prefix"."_meta` (`meta_id`,`query_string`,`path`, `meta_canonical`, `description`, `keyword`, `type`) VALUES ('3', '/', '$domain"."/"."', 'checked', '$home_description', '$home_keyword', 'home');";
$db->query($sql);echo $sql.'<br>';

//insert meta for the default post
$sql = "INSERT INTO `$prefix"."_meta` (`meta_id`,`query_string`,`path`, `meta_canonical`, `description`, `keyword`, `type`) VALUES ('4', '/welcome-to-microcms/', '$domain"."/welcome-to-microcms/', 'checked', 'MicroCMS is designed for simplicity and loading speed.','Mucms', 'post');";
$db->query($sql);echo $sql.'<br>';








/*******************************************************		

					BACK OFFICE SQL

*******************************************************/


//create user table only one mandatory table
$sql = "CREATE TABLE `$tprefix"."_users` (
  `user_id` int(11) NOT NULL auto_increment,
  `username` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `level` text NOT NULL,
  `email` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `password` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `crea_dat` datetime NOT NULL,
  `act_stat` varchar(1) character set utf8 collate utf8_unicode_ci NOT NULL default 'I',
  `hash` text character set utf8 collate utf8_unicode_ci NOT NULL,
  `user_group_id` int(11) NOT NULL default '0',
  `reg_ip` varchar(15) character set utf8 collate utf8_unicode_ci default NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";
$db->query($sql);
//insert default user
$sql = "INSERT INTO `$tprefix"."_users` (`user_id`, `username`, `level`, `email`, `password`, `crea_dat`, `act_stat`, `hash`, `user_group_id`, `reg_ip`) VALUES
(1, 'admin', 'admin', 'yvon.huynh@gmail.com', 'a7b6ca345d0fc16f344b4077214e3848', '0000-00-00 00:00:00', 'A', '', 0, NULL);";
$db->query($sql);


//create seo_urls BO
$sql = "CREATE TABLE `$tprefix"."_seo_urls` (
  `url_id` int(11) NOT NULL auto_increment,
  `url` text collate utf8_unicode_ci NOT NULL,
  `pagerank` varchar(2) collate utf8_unicode_ci NOT NULL,
  `nb_inlinks` int(11) NOT NULL,
  `nb_outlinks` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `timestamp` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`url_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;";
$db->query($sql);


//create linkbuilding table
$sql = "CREATE TABLE IF NOT EXISTS `$tprefix"."_linkbuilding` (
  `inlink_id` int(11) NOT NULL auto_increment,
  `page_id` int(11) NOT NULL,
  `source_url_id` int(11) NOT NULL,
  `source_url` text NOT NULL,
  `anchor` text NOT NULL,
  `rel` text NOT NULL,
  `pagerank` text NOT NULL,
  `link_type` text NOT NULL,
  `date` date NOT NULL,
  `misc` text NOT NULL,
  PRIMARY KEY  (`inlink_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$db->query($sql);

//create linkerati table
$sql = "CREATE TABLE IF NOT EXISTS `$tprefix"."_linkerati` (
  `linkerati_id` int(11) NOT NULL auto_increment,
  `external_url` text NOT NULL,
  `rel` text NOT NULL,
  `pagerank` text NOT NULL,
  `link_type` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY  (`linkerati_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
$db->query($sql);

echo 'Installation finished';