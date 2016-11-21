<?php
/*
<div class="ModalWindow">
    <?php if ($_SESSION['STATUS'] != "login") { ?>
    <label title="Регистрация" class="btn" for="modal-1">Регистрация</label>
	<label title="Вход" class="btn" for="modal-2">Вход</label>
	<?php } else if ($_SESSION['STATUS'] == "login") { ?>
	<label> Добро пожаловать, <?php echo $_SESSION['USER_LOGIN'] ?> </label>
	<a href = "/Account/logout.php"  class = "button" >Выход</a>
	<?php } ?>
</div>
*/
?>
<div id="modal_bkg" onclick="hideModal()">
	<div id="modal" onclick="event.stopPropagation();"></div>
</div>
<div id="topbar">
	<div class="pure-g" style="margin-left:60%;">     
		<?php if ($status != 1 or !$_COOKIE['user_cookie']) { ?> 
		<div class="pure-u-1-3" style = "width: auto; ">
			<a class="pure-button pure-button-primary menu-button" onmouseover='this.style.cursor="pointer"' onclick="loadModal('index.php?page=registration&view=modal')">Регистрация</a>
		</div> 
		<div class="pure-u-1-3" style = "width: auto; ">
			<a class="pure-button pure-button-primary menu-button" onmouseover='this.style.cursor="pointer"' onclick="loadModal('index.php?page=login&view=modal')">Вход</a>
		</div>
		<div class="pure-u-1-8" style="display: flex; align-items: center;width: auto; ">
			<a href="?page=login&action=restore" style="text-decoration: none; width: auto;">Забыли пароль?</a>
		</div>
		<?php } else { ?>
		<label> Добро пожаловать, <?php echo $login ?> </label>
		<div class="pure-u-1-3" style="width: auto;">
			<a href="?page=login&action=logout" class="pure-button pure-button-primary menu-button" style="width: auto;">Выход</a>
		</div>
		<?php } ?>
	</div>
</div>

