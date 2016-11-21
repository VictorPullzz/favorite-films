<?php
	require_once('modules/content.php');
	$cm = new ContentManager();
	$headers = $cm->getHeaders();
	$title = $cm->getTitle();
	$content = $cm->getContent();
?>
<head>
	<link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
	<link rel="stylesheet" href="/views/style.css">
	<title><? echo strip_tags($title); ?></title>
	<meta charset="utf-8"> <!--Возможны проблемы в браузерах, не поддерживающих HTML5-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
	<script src="script.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<!--script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script-->
	<? echo $headers; ?>
</head>
<body>
	<div id="page">
		<?php
		include_once('modules/topbar.php');			//Содержит шапку сайта
		include_once('modules/header.php');			//Содержит шапку сайта
		include_once('modules/menu.php');			//Содержит меню. Редактируется вручную!
		echo "<div id='page_title' style = 'text-align: center;'><h2>".$title."</h2></div><hr/>"; 
		echo "<div id='content'>".$content."<div>";	//Осуществляет работу со страницами
		include_once('modules/footer.php');			//Содержит подвал сайта
		?>
	</div>
</body>