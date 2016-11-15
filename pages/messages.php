<?php
class messages extends blank
{
	function getTitle()
	{
		return 'Сообщения';
	}
	
	function write($message = false)
	{
		if ($message)
		{
			if (is_string($message))
			{
				$to = $message;
			}
			else
			{
				$to = $message->login;
				$subject = 'Re: ' . $message->subject;
			}
		}
		ob_start();
		include 'message_form.html';
		$content = ob_get_clean();	
		return $content;
	}
	
	function submit()
	{
		if (_messages::sendMessage($_POST['to'], $_POST['subject'], $_POST['text']))
		{
			return Messager::showMessage("Сообщение успешно отправлено.");
		}
		return Messager::showError("ОШИБКА!");
	}
	
	function writeto()
	{
		return $this->write($_GET['to']);
	}
	
	function reply()
	{
		return $this->write(_messages::getMessage($_GET['mid']));
	}
	
	function delete()
	{
		_messages::deleteMessage($_GET['mid']);
		return $this->show();
	}
	
	function show()
	{
		$messages = _messages::getMessages();
		$view = isset($_GET['view']) ? $_GET['view'] : 'all';
		$result = '<span><a class="pure-button pure-button-primary" href="?page=messages&action=show&view=all">Все сообщения</a> ';
		$result .= '<a class="pure-button pure-button-primary" href="?page=messages&action=show&view=in">Входящие</a> ';
		$result .= '<a class="pure-button pure-button-primary" href="?page=messages&action=show&view=out">Отправленные</a> ';
		$result .= '<a class="pure-button pure-button-primary" href="?page=messages&action=write">Новое сообщение</a></span></br></br>';
		foreach ($messages as $message)
		{
			if ($view != 'all' && $message->target != $view)
				continue;
			$result .= "<div class=\"user_message user_message_{$message->target}\">
							<span class=\"subject\"><b>" . (($message->flags == 0) ? "&bull; " : "") . "$message->subject</b> <i>$message->time</i></span>
							<p>$message->text</p>
							<div class=\"sign\">
								<span><b>" . ($message->target == 'in' ?  "from" : "to") . ":</b> $message->login </span>
								<span>
									<a class=\"pure-button pure-button-primary\" href=\"?page=messages&action=delete&mid=$message->id\">Удалить</a>
									<a class=\"pure-button pure-button-primary\" href=\"?page=messages&action=reply&mid=$message->id\">Ответить</a>
								</span>
								<!--/br></br-->
								</div>
						</div>";
		}
		_messages::flushUnreadMessagesCount();
		return $result;
	}
}
?>