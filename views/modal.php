<?php
	require_once('modules/content.php');
	$cm = new ContentManager();
	$headers = $cm->getHeaders();
	$title = $cm->getTitle();
	$content = $cm->getContent();
?>
<a style="float: right;" onmouseover='this.style.cursor="pointer"' onclick="hideModal()">X</a><br>
<div>
	<?php
	//echo "<div id='page_title'><h2>$title</h2></div><hr/>"; 
	echo "<div id='content'>$content<div>";		//include_once('content.php');		//Осуществляет работу со страницами
	?>
</div>