<?php
?>
<div id="modal_bkg" onclick="hideModal()">
	<div id="modal" onclick="event.stopPropagation();"></div>
</div>
<div id="topbar">
	<div class="pure-g">
		<div class="pure-u-1-6"></div>
		<div class="pure-u-1-4"></div>
		<div class="pure-u-1-3"></div>
		<div class="pure-u-1-8">
		<?
		if (user::isLoggedIn())
			echo '<a class="pure-button pure-button-primary menu-button" href="?page=login&action=logout">Выйти</a>';
		else
			echo '<a class="pure-button pure-button-primary menu-button" onmouseover="this.style.cursor=\'pointer\'" onclick="loadModal(\'index.php?page=login&view=modal\')">Войти</a>';
		?>
		</div>
		<div class="pure-u-1-8" style="display: flex; align-items: center;"><a href="?page=login&action=restore" style="font-size: small;">Забыли пароль?</a></div>
	</div>
</div>