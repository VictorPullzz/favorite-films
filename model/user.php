<?php
//ЛК Юзеp
class user
{
	static function isLoggedIn()
	{
		return user::checkAccess('user');
	}
	
	static function checkAccess($category)
	{
		if (!isset($_SESSION['uid']))
			return false;
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("SELECT 1 FROM user_categories uc1, user_categories uc2 
							WHERE uc1.l <= uc2.l AND uc1.r >= uc2.r AND uc2.id = (SELECT cid FROM users WHERE id = $uid) AND uc1.category = '$category';");
		if ($q->num_rows > 0)
		{
			return $_SESSION['uid'];
		}
		return false;
	}
	
	static function getLogin()
	{
		return $_SESSION['login'];
	}
	
	static function logIn($login, $passw)
	{
		user::logOut();
		$conn = DBConnection::getInstance();
		$login = $conn->real_escape_string($login);
		$passw = MD5($passw);
		$q = $conn->query("SELECT id, login FROM users WHERE login='$login' AND pass='$passw';");
		if ($q->num_rows > 0)
		{
			$_SESSION['login'] = $login;
			return $_SESSION['uid'] = $q->fetch_object()->id;
		}
		return 0;
	}
	
	static function logOut()
	{
		unset($_SESSION['uid']);
	}
	
	static function registerUser($email, $passw)
	{
		user::logOut();
		$conn = DBConnection::getInstance();
		$login = $conn->real_escape_string($login);
		//$passw = user::generatePassword(6);
		$MD5passw = MD5($passw);
		$q = $conn->query("INSERT INTO users (login, pass) VALUES ('$email', '$MD5passw');");
		$uid = $_SESSION['uid'] = $conn->insert_id;
		$mail = "<div><h2>Поздравляем!</h2></div>";
		$headers = "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "From: Favorite Films\r\n";
		mail($email, 'Регистрация в личном кабинете Favorite Films', $mail, $headers);
		return $uid;
	}
	
	static function restorePass($login, $email)
	{
		user::logOut();
		$conn = DBConnection::getInstance();
		$login = $conn->real_escape_string($login);
		$email = $conn->real_escape_string($email);
		$passw = user::generatePassword(6);
		$MD5passw = MD5($passw);
		$q = $conn->query("SELECT pd.uid id FROM profiles_data pd JOIN users u ON u.id = pd.uid WHERE pd.fid = (SELECT id FROM profile_fields WHERE name = 'email') AND u.login = '$login' AND pd.value = '$email';");
		if ($q->num_rows != 1)
			return 1; //Код ошибки 1 - неверная пара логин/email
		$uid = $q->fetch_object()->id;
		$q = $conn->query("UPDATE users SET pass = '$MD5passw' WHERE id = $uid;");
		echo "UPDATE users SET pass = '$passw' WHERE id = $uid;";
		$mail = "<div><h2>Ваш пароль сброшен!</h2><p>Ваш пароль в Личном кабинете клуба Wiselife был сброшен!<br>Для входа в <a href=\"http://lk.wiselife.ru\">личный кабинет члена Клуба</a> используйте<br>логин: $login <br>пароль: $passw</p></div>";
		$headers = "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "From: WiseLife <info@wiselife.ru>\r\n";
		mail($email, 'Сброс пароля в личном кабинете Wiselife', $mail, $headers);
		return 0;
	}
	
	//Убрать это в какой-нибудь вспомогательный файл. Здесь этому не место.
	static function generatePassword($length = 8) 
	{
		$chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$count = mb_strlen($chars);

		for ($i = 0, $result = ''; $i < $length; $i++) 
		{
			$index = rand(0, $count - 1);
			$result .= mb_substr($chars, $index, 1);
		}

		return $result;
	}
	
	static function changePassword($passw, $newpassw)
	{
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$passw = MD5($passw);
		$newpassw = MD5($newpassw);
		$q = $conn->query("UPDATE users SET pass = '$newpassw' WHERE id = $uid AND pass = '$passw';");
		return $conn->affected_rows;

	}
	
	static function getUserID($login)
	{
		$conn = DBConnection::getInstance();
		$login = $conn->real_escape_string($login);
		$q = $conn->query("SELECT id FROM users WHERE login = '$login';");
		if ($q->num_rows > 0)
		{
			return $q->fetch_object()->id;
		}
		return false;
	}
}
?>