<?php
class my_profile extends blank
{
	function getTitle()
	{
		return 'Профиль';
	}
	
	function show()
	{		
		ob_start();
		include 'forms/profile.html';
		$content = ob_get_clean();	
		return $content;	
	}
}
?>