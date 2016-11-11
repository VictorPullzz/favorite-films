<?php
session_start();
include_once "../setting.php";
include_once "../main_function.php"; 

if ($_POST['enter'])
{
	if (!$_POST['email']) MessageSend(1, 'Невозможно обработать форму.');
	$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `login` FROM `Users` WHERE `email` = '$_POST[email]'"));
	if (!$Row['login']) MessageSend(1,'Пользователь не найден');
	$_POST['npassword'] = FormChars($_POST['npassword']);
	if ($_POST['npassword'])
	{
		if (!$_POST['npassword']) MessageSend(2, 'Не указан  новый пароль');
			$Password = GenPass($_POST['npassword'], $_POST['login']);
			mysqli_query($CONNECT, "UPDATE `Users` SET `password` = '$Password' WHERE `email` = $_POST[email]");
			header("Location: / "); 
			MessageSend(3, 'Пароль успешно изменен, для входа используйте новый пароль'.$Row['email'].'' );
    }
}




?>