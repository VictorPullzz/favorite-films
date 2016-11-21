<?php
class _messages
{
	static function getUnreadMessagesCount()
	{
		if (!user::checkAccess('user'))
			return 0;
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("SELECT COUNT(*) c FROM messages WHERE uid = $uid AND flags = 0;");
		return $q ? $q->fetch_object()->c : 0;
	}
	
	static function flushUnreadMessagesCount()
	{
		if (!user::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("UPDATE messages SET flags = 1 WHERE uid = $uid AND flags = 0;");
		return $q->affected_rows;
	}
	
	static function getMessages($target = 'both')
	{
		if (!user::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("SELECT m.*, (CASE m.sid WHEN $uid THEN 'out' ELSE 'in' END) target, u.login FROM messages m 
							LEFT JOIN users u ON u.id = (CASE m.sid WHEN $uid THEN m.uid ELSE m.sid END) 
							WHERE m.uid = $uid OR m.sid = $uid ORDER BY time DESC;");
		$result = array();
		while ($message = $q->fetch_object())
		{
			$result[] = $message;
		}		
		return $result;
	}
	
	static function getMessage($mid)
	{
		if (!user::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$mid = intval($mid);
		$q = $conn->query("SELECT m.*, u.login FROM messages m LEFT JOIN users u ON u.id = m.sid WHERE m.id = $mid AND m.uid = $uid;");
		$result = false;
		if ($message = $q->fetch_object())
		{
			$result = $message;
		}		
		return $result;
	}
	
	static function sendMessage($to, $subject, $text)
	{
		if (!user::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$to = $conn->real_escape_string($to);
		$subject = $conn->real_escape_string($subject);
		$text = $conn->real_escape_string($text);
		$q = $conn->query("SELECT id FROM users WHERE login = '$to';");
		if ($receiver = $q->fetch_object())
		{
			$q = $conn->query("INSERT INTO messages (sid, uid, subject, text) VALUES ($uid, $receiver->id, '$subject', '$text');");
			return true;
		}		
		return false;
	}
	
	static function deleteMessage($mid)
	{
		if (!user::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$mid = intval($mid);
		$q = $conn->query("DELETE FROM messages WHERE id = $mid;");
		return $q;
	}
}
?>