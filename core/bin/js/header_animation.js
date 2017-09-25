(function () {
	var header = document.getElementsByTagName('header')[0];
	var headroom = new Headroom(header);
	headroom.init();

	var links = $('.links');
		icon = $('#icon'),
		boton = $('#menu_btn'),
		ancho = $(window).width();

		boton.on('click',function () {
			links.slideToggle();
			icon.toggleClass('fa-bars');
			icon.toggleClass('fa-times');
		});

		if (ancho <= 700) {
			links.hide();
			icon.addClass('fa-bars');
		}

		$(window).on('resize',function () {
			if ($(this).width() >= 700) {
				links.show();
				icon.addClass('fa-bars');
				icon.removeClass('fa-times');
			}else {
				links.hide();
				icon.addClass('fa-bars');
				icon.removeClass('fa-times');
			}
		});
}());