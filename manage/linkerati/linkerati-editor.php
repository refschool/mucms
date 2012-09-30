<?php
include("linkerati_functions.php");
$link_id = $_GET['link_id'];
$l = get_single_linkerati($link_id)
?>
<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Linkbuilding</a></li>
		<li><a href="#tabs-2">Linkerati Source DB</a></li>
		<li><a href="#tabs-3">Yahoo backlinks</a></li>

	</ul>
	
	<div id="tabs-1">
		<h2>Linkbuilding Monitor</h2>

		<table class="collapse">
			<tr><td class="hlabel">Link Id</td><td class="hlabel">Page ID</td><td class="hlabel">Ext url</td><td class="hlabel">Anchor</td><td class="hlabel">rel</td><td class="hlabel">PR</td><td class="hlabel">Link type</td><td class="hlabel">Date</td><td class="hlabel">Misc</td></tr>
		<?php
		$l = get_linkbuilding();
		for($i=0;$i < count($l);$i++){
			echo '<tr>';
			echo '<td class="data" id="'.$l[$i]['inlink_id'].'">'.$l[$i]['inlink_id'].'</td>';
			echo '<td class="data edit" id="paged_'.$l[$i]['inlink_id'].'">'.$l[$i]['page_id'].'</td>';
			
			echo '<td class="data edit" id="sourc_'.$l[$i]['inlink_id'].'"><a href="'.$l[$i]['source_url'].'" target="_blank"> '.$l[$i]['source_url'].'</a></td>';
			echo '<td class="data edit" id="ancho_'.$l[$i]['inlink_id'].'">'.$l[$i]['anchor'].'</td>';
			echo '<td class="data" id="'.$l[$i]['inlink_id'].'">'.$l[$i]['rel'].'</td>';
			echo '<td class="data" id="'.$l[$i]['inlink_id'].'">'.$l[$i]['pagerank'].'</td>';
			echo '<td class="data edit" id="ltype_'.$l[$i]['inlink_id'].'">'.$l[$i]['link_type'].'</td>';
			echo '<td class="data" id="'.$l[$i]['inlink_id'].'">'.$l[$i]['date'].'</td>';
			echo '<td class="data edit" id="misce_'.$l[$i]['inlink_id'].'">'.$l[$i]['misc'].'</td>';			
			echo '</tr>';
		
		}
		
		?>
		</table>		
		
		<form action="linkbuilding-insert.php" method="post" >
		
		<label>Page ID</label>
		<input type="text" name="page_id" size="10" value="" /><br>	
		

		<label>Source Url</label>
		<input type="text" name="source_url" size="80" value="<?=$l['external_url'] ?>" /><br>

		<label>Anchor</label>
		<input type="text" name="anchor" size="50"  value="" /><br>
		
		<label>Rel</label>
		<input type="radio" name="rel" value="follow" checked />Follow
		<input type="radio" name="rel" value="nofollow" />Nofollow<br>

		<label>Link type</label>
		<input type="radio" name="link_type" value="Manual" checked />Manual
		<input type="radio" name="link_type" value="Exchange" />Exchange<br>
		

		<br>			

		<label>Date</label>
		<input type="text" name="date" size="10" value="<?=date('Y-m-d')?>" /><br>	
		
		<label>Note</label>
		<input type="text" name="misc" size="50"  value="" /><br>
		
		<input type="submit" value="Add link source" />
		</form>

		
	</div>
	
	<div id="tabs-2">
	<h2>Links Source DB</h2>
	<!--potential link source-->
		
	<table class="collapse">
	<tr><td class="hlabel">Link Id</td><td class="hlabel">Ext Url</td><td class="hlabel">Rel</td><td class="hlabel">PR</td><td class="hlabel">Link Type</td><td class="hlabel">Date</td><td class="hlabel">Action</td></tr>
		<?php
		$linkerati = get_linkerati();
		for($i=0;$i < count($linkerati);$i++){
			echo '<tr>';
			echo '<td class="data">'.$linkerati[$i]['linkerati_id'].'</td>';
			echo '<td class="data"><a href="'.$linkerati[$i]['external_url'].'" target="_blank"> '.$linkerati[$i]['external_url'].'</a></td>';
			echo '<td class="data">'.$linkerati[$i]['rel'].'</td>';
			echo '<td class="data">'.$linkerati[$i]['pagerank'].'</td>';
			echo '<td class="data">'.$linkerati[$i]['link_type'].'</td>';
			echo '<td class="data">'.$linkerati[$i]['date'].'</td>';
			echo '<td class="data"><a href="'.$tld.'manage/linkerati/index.php?link_id='.$linkerati[$i]['linkerati_id'].'">Build a link</a></td>';
			echo '</tr>';
		
		}
		
		?>
		</table>
		<a href="">Compute PR</a>
		<br style="clear:both" />
		
		<h2>Add a link</h2>
		<form action="linkerati-insert.php" method="post" >
		
		<label>External Url</label>
		<input type="text" name="external_url" size="50" value="" /><br>

		<label>Rel</label>
		<input type="text" name="rel" size="15"  value="follow" /><br>

		<label>Pagerank</label>
		<input type="text" name="pagerank" value="" /><br>	

		<label>Link type</label>
		<input type="radio" name="link_type" value="Manual" checked />Manual
		<input type="radio" name="link_type" value="Exchange" />Exchange<br />

		<br>			

		<label>Date</label>
		<input type="text" name="date" size="10" value="<?=date('Y-m-d')?>" /><br>	
		
		<input type="submit" value="Add" />
		</form>
	</div>
	
	<div id="tabs-3">

	</div>

</div>