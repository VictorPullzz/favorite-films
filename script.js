function showModal(modalblock) {
	$('#modal_bkg').css("display", "flex");
	$('#modal').html(modalblock);
}

function hideModal() {
	$('#modal').html("");
	$('#modal_bkg').hide();
}

function loadModal(url) {
	$.get(url, function(data) { showModal(data); });
}

function sendForm(url) {
	var data = $('#form').serialize();
	$.post(url, data).done(onSuccess).fail(function(){alert("fail");});
	//location.reload();
	//hideModal();
}

function onSuccess(data) {
	//alert(data);
	var response = $.parseJSON(data);
	alert(response.message);
	if (response.action == "reload")
		location.reload();
}/*
$(window).scroll(function(){
	if ($(window).scrollTop() > $('header').height()+10)
		$('menu').addClass('fixed');
	else
		$('menu').removeClass('fixed'); 
});*/
var h_hght = 150; // высота шапки
var h_mrg = 0;    // отступ когда шапка уже не видна
                 
$(function(){
	var elem = $('#menu');
    var top = $(this).scrollTop();
     
    if(top > h_hght){
        elem.css('top', h_mrg);
    }           
     
    $(window).scroll(function(){
        top = $(this).scrollTop();
         
        if (top+h_mrg < h_hght) {
            elem.css('top', (h_hght-top));
        } else {
            elem.css('top', h_mrg);
        }
    });
 
});