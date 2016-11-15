<?php
if (!user::isLoggedIn())
	return '';
?>
<div id="menu">
	<div class="pure-g">
    		<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="#">Моя страница</a></div>
    		<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="#">Профиль</a></div>
    		<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="/?page=messages">Сообщения <? echo (($c = _messages::getUnreadMessagesCount()) == 0) ? "" : "($c)"; ?></a></div>
			<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="#">Рекомендации</a></div>
    		<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="#">Мои оценки</a></div>
    		<div class="pure-u-1-6"><a class="pure-button pure-button-primary menu-button" href="/?page=films">Фильмы</a></div>
	</div>
</div>