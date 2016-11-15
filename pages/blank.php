<?php
class blank
{
	var $private = false;
	
	function getHeaders()
	{
		return '';
	}
	
	function getTitle()
	{
		return '';
	}
	
	function show()
	{
		return '';
	}
	
	function getContent($action = null)
	{
		if ($this->private && !user::isLoggedIn())
		{
			return Messager::showError("This page is available only for registered users!");
		}
		
		$action = isset($action) ? $action : "show";
		if (method_exists($this, $action))
		{
			return $this->$action();
		}
		return Messager::showError("Wrong action " . $action);
	}
}
?>