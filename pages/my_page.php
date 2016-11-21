<?php
class my_page extends blank
{
	function getTitle()
	{
		return 'Мой профиль';
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