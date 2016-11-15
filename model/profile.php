<?php
class _profile 
{
	static function getProfile()
	{
		if (!self::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$q = $conn->query("(SELECT login value, 'login' name, 'Login' alias, 'Основная информация' category FROM users WHERE id = $uid) UNION 
			(SELECT pd.value, pf.name, pf.alias, pf.category FROM profile_fields pf LEFT JOIN (SELECT * FROM profiles_data WHERE uid = $uid) pd ON pd.fid = pf.id);;");
		$result = array();
		while ($field = $q->fetch_object())
		{
			$field_name = $field->name;
			$result[$field_name] = new stdClass();
			$result[$field_name]->value = $field->value;
			$result[$field_name]->alias = $field->alias;
			$result[$field_name]->category = $field->category;
		}
		return $result;
	}
	
	static function setProfile($profile)
	{
		if (!self::checkAccess('user'))
			throw new Exception("user not logged in!!!!");
		$uid = $_SESSION['uid'];
		$conn = DBConnection::getInstance();
		$conn->autocommit(false);
		//$stmt = $conn->prepare("REPLACE INTO profiles_data SET uid = $uid, fid = (SELECT id FROM profile_fields WHERE name = ? LIMIT 1), value = ?;");
		$stmt = $conn->prepare("CALL P1($uid, ?, ?);");
		$stmt->bind_param('ss', $name, $value);
		foreach ($profile as $name => $value)
		{
			$stmt->execute();
		}
		$stmt->close();
		return $conn->commit();	
	}
}
?>