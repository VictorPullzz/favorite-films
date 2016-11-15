<?php
require_once('pages/blank.php');

class ContentManager
{
	var $CC;
	var $action;
	
	function __construct ()
	{
		$page = $_GET['page'];
		$this->action = $_GET['action'];
		if ($page == '')
			$page = 'welcome_page';
		if (include_once('pages/' . $page . '.php'))
		{
			$this->CC = new $page();
		}
		else
		{
			include_once('pages/notfound.php');
			$this->CC = new notfound();
		}
	}
	
	function getHeaders()
	{
		return $this->CC->getHeaders();;
	}
	
	function getTitle()
	{
		return $this->CC->getTitle();
	}

	function getContent()
	{
		return $this->CC->getContent($this->action);
	}
}
?>