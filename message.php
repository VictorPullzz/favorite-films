<?php
class Messager
{
	private static $instance;
	
	static function showMessage($message, $error = false)
	{
		if ($error)
			return Messager::showError($message);
		return '<div class="message"><p>' . $message . '</p></div>';
	}

	static function showError($message)
	{
		return '<div class="error"><p>' . $message . '</p></div>';
	}
}
?>