<?php
class films extends blank
{
	function getTitle()
	{
		return 'Фильмы';
	}
	
	function getHeaders()
	{
		return '<link rel="stylesheet" href="/styles/films.css">';
	}
	
	function show()
	{		
		$content = '<div class="pure-g">';
		foreach (_films::getFilms() as $film)
			$content .= "<div class='pure-u-1-3 film_item'>$film->title</div>";
		return $content . '</div>';	
	}
}
?>