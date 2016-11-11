<?php 
session_start();
include_once "../setting.php";
include_once "../main_function.php"; 

if ($_POST['enter'])
{
$_POST['login'] = FormChars($_POST['login']);
$_POST['email'] = FormChars($_POST['email']);
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `Users` WHERE `login` = '$_POST[login]'"));
if ($Row['login']) MessageSend(1,'Логин <b>'.$_POST['login'].'</b> уже используется.');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `Users` WHERE `email` = '$_POST[email]'"));
if ($Row['email']) MessageSend(1,'E-Mail <b>'.$_POST['email'].'</b> уже используется.');
$Reg = mysqli_query($CONNECT, "INSERT INTO `Users` VALUES ('', '$_POST[login]', '$_POST[password]', NOW(),'$_POST[email]',1,0)" ) or die ("Error registration user");
if ($Reg)
{
	MessageSend(3,'Регистрация аккаунта успешно завершена!');
}
}
header("Location: /");
?>




