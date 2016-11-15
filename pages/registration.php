<?php
class registration extends blank
{
	function getTitle()
	{
		return 'Регистрация';
	}
	
	function show()
	{
		$r = $_GET['r'];
		ob_start();
		include 'forms/registration.html';
		$content .= ob_get_clean();	
		return $content;	
	}
	
	function submit()
	{
		$login = $_POST['email'];
		$pass = $_POST['pass'];
		if (user::getUserID($login))
		{
			$content .= Messager::showError("Пользователь $login уже зарегистрирован!") . $this->getContent();
			return $content;
		}
		if (user::registerUser($login, $passw))
		{
			$content .= Messager::showMessage("Регистрация прошла успешно!");
			ob_start();
			include 'welcome_page.html';
			$content .= ob_get_clean();
			return $content;
		}
		$content .= Messager::showError("Something wrong!");
		return $content;	
	}
}
?>