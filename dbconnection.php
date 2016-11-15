<?php
class DBConnection
{
	private static $instance;
	
	private function __construct()
	{
		throw new Exception("This is a static class!");
	}
	
	static function getInstance()
	{
		if (!isset(DBConnection::$instance))
		{
			require_once('dbconfig.php');
			DBConnection::$instance = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
			/*
			if (mysqli_connect_errno()) 
			{ 
				$logMessage = " Подключение к серверу MySQL невозможно. Код ошибки: " . mysqli_connect_error(); 
				echo $logMessage;
				$logMessage = date('d.m.y H:i', time()) . $logMessage . "\n";
				file_put_contents('log.txt', $logMessage, FILE_APPEND);
				exit; 
			}
			*/
			DBConnection::$instance->set_charset("utf8");
		}
		return DBConnection::$instance;
	}
}
?>