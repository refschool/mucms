<?php

include("../inc/config.php");
include("inc/php/manager-functions.php");
	
$new_post_id = create_post();
?>
<meta http-equiv="refresh" content="1;url=<?=$tld2?>/manage/write.php?id=<?=$new_post_id?>">
