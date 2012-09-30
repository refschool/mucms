<?php
//legacy hooks

//meta
$hook['meta_title'][10] = 'get_title' ;

$hook['meta_desc'][10] = 'get_description' ;

$hook['meta_kw'][10] = 'get_keyword' ;
$hook['meta_robots'][10] = 'get_meta_robots' ;
$hook['verification'][10] = 'get_verification' ;
//header
$hook['menu'][10] = 'get_menu' ;

//body
$hook['body'][10] = 'get_body';

$hook['comments'][10] = 'get_comments';
$hook['comment_form'][10] = 'comment_form';
$hook['comment_count'][10] = 'get_comment_count';
//sidebar
$hook['sidebar'][10] = 'get_sidebar' ;

$hook['sidebar_item'][10] = 'show_sidebar_tag' ;

$hook['sidebar_item'][20] = 'show_sidebar_category' ;

$hook['sidebar_item'][30] = 'show_latest_posts' ;

//footer
$hook['footer'][10] = 'get_footer' ;