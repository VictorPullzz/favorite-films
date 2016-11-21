<?php
//ЛК Юзер
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
	
	static function FormChars($p1) {
		return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
	}  
	  
	static function GenPass($p1, $p2) {
		return md5('dasoicuboasiugoiubnkzxcviuywlkjpz'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
	}
	
	static function logIn($login, $password)
	{
		user::logOut();
		$conn = DBConnection::getInstance();
		$q = $conn->query("SELECT id, login, password, email, avatar, date_register, country, age, sex FROM user WHERE login='$login' AND password = '$password';");
		if ($q->num_rows > 0)
		{
			$uid = $_SESSION['USER_ID'] = $q->fetch_object()->id;
			$login = $_SESSION['USER_LOGIN'] = $q->fetch_object()->login;
			$password = $_SESSION['USER_PASSWORD'] = $q->fetch_object()->password;
			$email = $_SESSION['USER_EMAIL'] = $q->fetch_object()->email;
			$avatar = $_SESSION['USER_AVATAR'] = $q->fetch_object()->avatar;
			$date_register = $_SESSION['USER_REGDATE'] = $q->fetch_object()->date_register;
			$country = $_SESSION['USER_COUNTRY'] = $q->fetch_object()->country;
			$age = $_SESSION['USER_AGE'] = $q->fetch_object()->age;			
			$sex = $_SESSION['USER_SEX'] = $q->fetch_object()->sex;
			$status = $_SESSION['STATUS'] = 1;
			if ($_REQUEST['remember']) setcookie('user_cookie', "FF".$uid."USER".$login."", strtotime('+30 days'), '/');
			return $q + $status;
		}
		return 0;
	}
	
	static function logOut()
	{
		if ($_COOKIE['user_cookie']) 
		{	
			setcookie('user_cookie', '', strtotime('-30 days'), '/');	 
			unset($_COOKIE['user_cookie']);
		}
		session_unset();
	}
	static function registerUser($login, $email, $password)
	{
		user::logOut();
		$conn = DBConnection::getInstance();
		$q = $conn->query("INSERT INTO user (login, email, password, date_register) VALUES ('$login', '$email', '$password', NOW());");
		$uid = $_SESSION['uid'] = $conn->id;
		$code = str_replace('=', '', base64_encode($email));
		$mail = "<div><h2>Поздравляем!</h2><p>Вы успешно зарегистрировались на сайте Favorite-Films!<br>Для входа в <a href=\"http://favorit-films.esy.es\"> профиль </a> используйте<br>логин: $login <br>пароль: $password </p></div><br> Чтобы зарегистрироваться перейдите по ссылке: http://favorit-films.esy.es/?page=registration&action=activate?code='".substr($code,-6).substr($code,0,-6);
		$headers = "Content-Type: text/html; charset=UTF-8\r\n";
		$headers .= "From: admin <info@wiselife.ru>\r\n";
		mail($email, 'Регистрация на сайте Favorite-Films', $mail, $headers);
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
		$q = $conn->query("SELECT id FROM user WHERE login = '$login';");
		if ($q->num_rows > 0)
		{
			return $q->fetch_object()->id;
		}
		return false;
	}
}
?>