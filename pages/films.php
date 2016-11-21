<?php
class films extends blank
{
	function getTitle()
	{
		return 'Фильмы';
	}
	
	function show()
	{		
		ob_start();
		include 'forms/login.html';
		$content = ob_get_clean();	
		return $content;	
	}
}
?>