<?php
class registration extends blank
{
	function getTitle()
	{
		return 'Регистрация';
	}
	
	function show()
	{
		ob_start();
		include 'forms/registration.html';
		$content .= ob_get_clean();	
		return $content;	
	}	
	function profile()
	{		
		ob_start();
		include 'forms/profile.html';
		$content = ob_get_clean();	
		return $content;	
	}
	function welcome_page()
	{		
		ob_start();
		include 'forms/welcome_page.html';
		$content = ob_get_clean();	
		return $content;	
	}
	
	function submit()
	{
		$login = user::FormChars($_POST['login']);
		$email = user::FormChars($_POST['email']);
		$password = user::GenPass(user::FormChars($_POST['password']), $login);
		if (user::getUserID($login))
		{
			$content .= Messager::showError("Пользователь $login уже зарегистрирован!") . $this->getContent();
			return $content;
		}
		if (user::registerUser($login, $email, $password))
		{
			$content .= Messager::showMessage("Регистрация прошла успешно! На указанный E-mail адрес $email отправленно письмо о подтверждении регистрации, а так-же Ваш логин и пароль");
			$content .= $this->welcome_page();
			return $content;
		}
		$content .= Messager::showError("Something wrong!");
		return $content;	
	}

	function activate()
	{
		if(!$_SESSION['USER_ACTIVE_EMAIL'])
		{
			$code = $_GET['code'];
			$email = base64_decode(substr($code, 6).substr($code, 0, 6));
			if(strpos($email, '@') !== false)
			{
				$conn = DBConnection::getInstance();
				$q = $conn->query("UPDATE user SET active = 1 WHERE email = '$email'");
				$_SESSION['USER_ACTIVE_EMAIL'] = $email;
				$content .= Messager::showMessage('E-mail <b>'.$email.'</b> подтвержден.');
				$content .= $this->profile();
				return $content;
			}
			else $content .= Messager::showMessage('E-mail адрес не подтвержден.');
			$content .= $this->welcome_page();
			return $content;
		}
		else $content .= Messager::showMessage('E-mail адрес <b>'.$_SESSION['USER_ACTIVE_EMAIL'].'</b> уже подтвержден.');
		$content .= $this->profile();
		return $content;
	}
}
?>