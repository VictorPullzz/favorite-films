<?php
class login extends blank
{
	
	function getTitle()
	{
		return 'Страница входа';
	}
	
	function logout()
	{
		user::logOut();
		return $this->show();
	}
	
	function submit()
	{
		$login = $_POST['login'];
		$passw = $_POST['passw'];
		if (!user::logIn($login, $passw))
		{
			//return '<meta http-equiv="refresh" content="0;URL=http://lk.wiselife.ru/?page=welcome_page">';
			return Messager::showError("Неверный логин или пароль!") . $this->getContent();
		}
		$content = '<meta http-equiv="refresh" content="0;URL=/?page=welcome_page">';
		return $content;
	}
	
	function restore()
	{
		ob_start();
		include 'forms/restorepass.html';
		$content = ob_get_clean();
		return $content;
	}

	function restoresubmit()
	{
		$content = '';
		if (user::restorePass($_POST['login'], $_POST['email']) > 0)
			$content .= Messager::ShowError("Неверная пара логин/email!") . $this->restore();
		else
			$content .= Messager::ShowMessage("Ваш пароль сброшен. Новый пароль отправлена на Ваш e-mail!");
		return $content . $this->show();;
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