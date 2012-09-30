<?php
include("pr.class.php");
//include("../inc/config.php");
$p = new pagerankChecker();

//connection
@$db = new mysqli($host,$user,$pass,$db);
if (mysqli_connect_errno())
{
echo 'Error  : could not connect to database. Try again';
exit;
}
//query
$sql = "select * from `mc_content` order by `thisurl`";
$result = $db->query($sql);
while($row = $result->fetch_assoc()){
$i++;
	$url_array[$i] ["url"]= $row["thisurl"]; 
	$url_array[$i]["pagerank"] = $p->getpr($row["thisurl"]); 
	
}

?>

<table border="1">
<?php
$p = new pagerankChecker();

for($i=0;$i<count($url_array);$i++){
$pagerank = $p->pagerank($url_array[$i]["url"]);if(isset($pagerank)){} else {$pagerank = 'U';}

	echo '<tr><td>'.$url_array["$i"]["url"].'</td><td>'.$pagerank.'</td></tr>';
}
//print_r($this_url);echo $sql;

?>
</table>
