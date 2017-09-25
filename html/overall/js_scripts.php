<script src="<?php echo JS_URL ?>jquery.min.js"></script>
<script src="<?php echo JS_URL ?>header_animation.js"></script>
<script>
	window.onload = function () {	
		var main = document.getElementById('main');
		if (main.offsetHeight < window.innerHeight) {
			main.style.height = window.innerHeight + 'px';
		}else if (main.pixelHeight < window.innerHeight) {
			main.style.height = window.innerHeight + 'px';
		}
	}
</script>
<script>
	$(window).on('resize',function () {
		if ($(this).width() <= 700) {
			if ($('#main').height() <= 450) {
				$('#main').height('450px');
			}else {	
				$('#main').height('auto');
			}
		}else {
			$('#main').height( $(this).height() + 'px');
		}
	});
</script>
<script>
		function share() {
			FB.ui(
			 {
			  method: 'share',
			  href: 'http://elvis.com:8085/projects/lovers/'
			}, function(response){});
		}
</script>