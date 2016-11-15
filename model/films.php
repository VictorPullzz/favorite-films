<?php
class _films 
{
	static function getFilms($startFrom = 0, $limit = 10, $filter = null)
	{
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("SELECT * FROM films;");
		$result = array();
		while ($film = $q->fetch_object())
		{
			$result[] = $film;
		}
		return $result;
	}
}
?>