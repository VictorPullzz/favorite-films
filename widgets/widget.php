<?php
class widget
{
	static function parse($text)
	{
		$regex = '/{"widget"[^{}]*}/';
		return preg_replace_callback($regex, array('widget', 'replace'), $text);
		return $text;
	}
	
	static function replace($matches)
	{
		$obj = json_decode($matches[0]);
		require($obj->widget . ".php");
		return $content;
	}
}
?>