<?php
class recommendation extends blank
{
	function getTitle()
	{
		return 'Рекомендации';
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