<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Recuperacion de contraseña</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>password_reg.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>	
			<main id="main">
				<div class="form">
					<div id="message_wrap" class="message">
						<span><i id="icon_loading" class="fa fa-refresh" aria-hidden="true"></i></span>
						<p id="message_text">Pene pal que lea</p>
						<span><i id="icon" class="fa fa-times" aria-hidden="true"></i></span>
					</div>
					<form method="POST" onkeypress="return go(event)" enctype="application/-x-www-form-urlencoded">
						<h2>¿Olvidaste tu contraseña?</h2>
						<div class="input">
							<label for="email">Escribe tu direccion de correo electronico:</label>
							<input type="email" name="email" id="email" placeholder="Email">
						</div>
						<input type="button" value="Enviar" onclick=" var email = document.getElementById('email'); if (email.value == '') {return false;} else {ajax();  $('#message_wrap').show();}">
					</form>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS; ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>password_reg_conexion.js"></script>
	<?php include JS_SCRIPTS ?>
	<script>
		var icon = $('#message_wrap #icon');
		var wrap = $('#message_wrap');

		icon.on('click',function () {
			wrap.slideUp();
		});
	</script>
</body>
</html>