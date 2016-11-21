<?php
class my_evaluation extends blank
{
	function getTitle()
	{
		return 'Мои оценки';
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