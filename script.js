function showModal(content) {
	$('#modal_bkg').css("display", "flex");
	$('#modal').html(content);
	$('#modal form').bind("submit", function(event) {
		event.preventDefault();
		sendForm($('#modal form').attr('action'));
	});
}

function hideModal() {
	$('#modal').html("");
	$('#modal_bkg').hide();
}

function loadModal(url) {
	$.get(url, function(data) { showModal(data); });
}

function sendForm(url) {
	var data = $('#modal form').serialize();
	$.post(url + "&view=modal", data).done(onSuccess).fail(function(){alert("fail");});
	//location.reload();
	//hideModal();
}

function onSuccess(data) {
	showModal(data);
	/*
	var response = $.parseJSON(data);
	alert(response.message);
	if (response.action == "reload")
		location.reload();*/
	//$('html').html(data);
}