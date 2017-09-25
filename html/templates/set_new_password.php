<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Escribe una nueva contraseña</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>set_new_password_styles.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<div class="form" id="password_form">
					<div class="message" id="message_wrap">
						<span><i class="icon fa fa-refresh" aria-hidden="true"></i></span>
						<p id="msj_text"></p>
						<span></span>
					</div>
					<form onkeypress="return go(event)">
						<h2>Escribe una nueva contraseña</h2>
						<div class="pass1">
							<label for="password" id="password_label">Contraseña:</label>
							<input type="password" name="pass1" id="password" placeholder="Contraseña">
						</div>
						<div class="pass2" id="password_r_label">
							<label for="password_r">Repite tu contraseña</label>
							<input type="password" name="pass2" id="password_r" placeholder="Repite su contraseña">
						</div>
						<input type="button" value="Enviar" onclick="if(document.getElementById('password').value === '' || document.getElementById('password_r').value === '') {return false;}else{go_ajax();}">
					</form>
				</div>
				<div class="message" id="mensaje_exito">
					<h2>Felicidades!</h2>
					<p>Felicidades tu contraseña fue perfectamente cambiada, ahora solo tienes que <a href="login">Iniciar sesion</a></p>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>set_new_password.js"></script>
	<?php include JS_SCRIPTS ?>
</body>
</html>