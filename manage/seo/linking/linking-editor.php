<div id="tabs">
	<ul>
		<li><a href="#tabs-1">Backlinks</a></li>
		<li><a href="#tabs-2">Robots.txt</a></li>
	</ul>
	
	<div id="tabs-1">
		<?php
		$backlinks = get_backlinks();
		
		echo '<table class="collapse">';
		echo '<tr><td class="hlabel">Url</td><td class="hlabel">Pagerank</td></tr>';
		for($i=0;$i<count($seo_urls);$i++){
			echo '<tr>';
			echo '<td class="data"><a href="'.$seo_urls[$i]['url'].'">'.$seo_urls[$i]['url'].'</a></td>';
			echo '<td class="data">'.$seo_urls[$i]['pagerank'].'</td>';
			echo '</tr>';
		
		}
		echo '</table>';
		
			?>
			
		<a href="<?=$tld?>manage/seo/compute_pr.php">Compute pagerank</a>
		
		<br style="clear:both" />
	</div>
	
	<div id="tabs-2">
		<form action="seoupdate.php" method="post" >
			<textarea id="robots" name="robots" rows="15" cols="70"><?php 
			$file = '../../robots.txt';
			$handle = fopen($file,'r');
			$buffer = fread($handle, filesize($file)) ;
				fclose($handle);	
				echo $buffer;

			?></textarea>

	</div>
	
	<div id="tabs-3">

	</div>
			<input type="submit" value="Update" />
		</form>
</div>