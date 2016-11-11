<?php
session_start();
function FormChars ($p1) {
return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}  
function GenPass ($p1, $p2) {
return md5('ksahdiuashdasouidaso'.md5('321'.$p1.'123').md5('678'.$p2.'890'));
}
function MessageSend($p1,$p2, $p3= ''){
if ($p1 == 1) $p1 = 'Ошибка';
else if ($p1 == 2) $p1 = 'Подсказка';
else if ($p1 == 3) $p1 = 'Информация';
$_SESSION['message'] = '<div class = "MessageBlock"><b>'.$p1.'</b>: '.$p2. '</div>';	
if ($p3) $_SERVER['HTTP_REFERER'] = $p3;	
	exit(header('Location: ' .$_SERVER['HTTP_REFERER']));
}
function MessageShow(){
if ($_SESSION['message']) $Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}
?>