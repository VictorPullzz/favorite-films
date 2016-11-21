<?php
class DBConnection
{
	private static $CONNECT;
	private function __construct()
	{
		throw new Exception("This is a static class!");
	}
	static function getInstance()
	{
		if (!isset(DBConnection::$CONNECT))
		{
			require_once('dbconfig.php');
			DBConnection::$CONNECT = new mysqli(HOST, USER, PASSOWROD, DB);
			DBConnection::$CONNECT->set_charset("utf8");
		}
		return DBConnection::$CONNECT;
	}
}
?>