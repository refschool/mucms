<?php

include("../inc/config.php");
include("class/manager-functions.php");
	
$new_post_id = create_post();

echo "<meta http-equiv=\"refresh\" content=\"0;URL=$tld"."manage/write.php?id=$new_post_id\">";
?>