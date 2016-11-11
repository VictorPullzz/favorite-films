<div class = "content">
<?php
    if(!isset($_GET['page']))
    {
		$page = 'main';
	}else
	{
		$page = addslashes(strip_tags(trim($_GET['page'])));
	}
	if ($page == '')
	{
		$page = 'main';
	}
	if (include_once('page/'.$page.'.php'))
	{
		include_once('page/'.$page.'.php');
	}
	else 
	{
		include_once('page/notfound.php');
	}
?>
</div>
