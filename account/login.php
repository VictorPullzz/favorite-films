<?php
session_start();
include_once "../setting.php";
include_once "../main_function.php"; 

if ($_POST['enter']) {
$_POST['login'] = FormChars($_POST['login']);	
$_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);	
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `Users` WHERE `login` = '$_POST[login]'"));
if ($Row['password'] != $_POST['password']) MessageSend(1,'Неверный логин или пароль');
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `regdate`, `email`, `password`, `login`, `avatar`  FROM `Users` WHERE `login` = '$_POST[login]'"));
$_SESSION['USER_ID'] = $Row['id'];
$_SESSION['USER_LOGIN'] = $Row['login'];
$_SESSION['USER_PASSWORD'] = $Row['password'];
$_SESSION['USER_EMAIL'] = $Row['email'];
$_SESSION['USER_REGDATE'] = $Row['regdate'];
$_SESSION['USER_AVATAR'] = $Row['avatar'];
$_SESSION['STATUS'] = "login";
if ($_REQUEST['remember']) setcookie('user', $_POST['password'], strtotime('+30 days'), '/');
header("Location: /?page=profile");
}
?>