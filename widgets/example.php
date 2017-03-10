<?php
$film = _films::getRandomFilm();
//$content = "<div class='pure-u-1-3 film_item'>$film->title</div>";
$content = "<div class='pure-u-1-3 film_item'><img src='$film->img'/></div>";
/*
ob_start();
?>
<div>
	<span>This is an example widget. <? echo $obj->text; ?></span>
</div>
<?
$content = ob_get_clean();
?>*/