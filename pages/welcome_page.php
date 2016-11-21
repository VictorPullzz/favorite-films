<?php
class welcome_page extends blank
{
	function getTitle()
	{
		return 'Главная страница';
	}
	function show()
	{
		ob_start();
		include 'forms/welcome_page.html';
		$content .= ob_get_clean();	
		return $content;	
	}
}

?>
