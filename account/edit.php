<?php 
session_start();
include_once "../setting.php";
include_once "../main_function.php"; 

if ($_POST['enter']) 
{
	$_POST['opassword'] = FormChars($_POST['opassword']);	
	$_POST['npassword'] = FormChars($_POST['npassword']);
	if ($_POST['opassword'] or $_POST['npassword'])
	{
		if (!$_POST['opassword']) MessageSend(2, 'Не указан старый пароль');
		if (!$_POST['npassword']) MessageSend(2, 'Не указан  новый пароль');
		if ($_SESSION['USER_PASSWORD'] != GenPass($_POST['opassword'], $_SESSION['USER_LOGIN']))  MessageSend(1, 'Старый пароль указан неверно');
		$Password = GenPass($_POST['npassword'], $_SESSION['USER_LOGIN']);
		mysqli_query($CONNECT, "UPDATE `Users` SET `password` = '$Password' WHERE `id` = $_SESSION[USER_ID]");
		$_SESSION['USER_PASSWORD'] = $Password;
		header("Location: /?page=profile"); 
	}
	if ($_FILES['Avatar']['tmp_name'])
	{
		if ($_FILES['Avatar']['type'] != 'image/jpeg') MessageSend(2, 'Неверный тип изображения.');
		if ($_FILES['Avatar']['size'] > 20000) MessageSend(2, 'Размер аватара слишком большой.');
		$Image = imagecreatefromjpeg($_FILES['Avatar']['tmp_name']);
		$Size = getimagesize($_FILES['Avatar']['tmp_name']);
		$Tmp = imagecreatetruecolor(120,120);
		imagecopyresampled($Tmp, $Image, 0,0,0,0,120,120,$Size[0],$Size[1]);
		
		if ($_SESSION['USER_AVATAR'] == 0) 
		{
			$Files = glob ('Resource/Avatar/*', GLOB_ONLYDIR);
		foreach($Files as  $num => $Dir)
		{
			$Num++;
			$Count = sizeof(glob($Dir.'/*.*'));
			if($Count < 250)
			{
				$Download = $Dir.'/'.$_SESSION['USER_ID'];
				$_SESSION['USER_AVATAR'] = $Num;
				mysqli_query($CONNECT, "UPDATE `Users` SET `avatar` = $Num WHERE `id` = $_SESSION[USER_ID]");
				break;       
			}
		}	
		}
		else $Download = 'Resource/Avatar/'.$_SESSION['USER_AVATAR'].'/'.$_SESSION['USER_ID'];
		imagejpeg($Tmp,$Download.'.jpg');
		imagedestroy($Image);
		imagedestroy($Tmp);
	}
	MessageSend(3, 'Данные изменены');
}
?>