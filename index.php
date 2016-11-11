<head>
    <meta charset="UTF-8">
    <link href = "resources/styles_scripts/styles_mainNNNNNNNNNN.css" rel="stylesheet">
</head>
<?php
	session_start();
	include_once 'setting.php'; 
	include_once 'main_function.php';
?>
<body>
    <div class = "page">
        <?php
		include_once "header.php";
		include_once "left.php";
		include_once "menu.php";
		MessageShow();
        include_once "content.php";	
		include_once "footer.php";
	    ?>
	</div>
</body>
