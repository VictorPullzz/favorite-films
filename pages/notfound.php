<?php
class notfound
{
	function getTitle()
	{
		return '<H3>Page non found</H3><hr>';
	}
	
	function getContent()
	{
		return Messager::showError("404 Page non found!");
	}
}
?>