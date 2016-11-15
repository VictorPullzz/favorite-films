<?php
session_start(); //Стартуем работу с сессией
define('DEFAULT_VIEW', 'default');

require_once('dbconnection.php');	//Содержит класс для работы с БД
require_once('message.php');		//Содержит класс для вывода сообщений и ошибок
foreach (glob("model/*.php") as $filename)
{
	require_once($filename);
}
$view = $_GET['view'];
if (!isset($view))
	$view = DEFAULT_VIEW;
include_once("views/$view.php");
?>