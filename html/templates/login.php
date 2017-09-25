<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Iniciar sesion</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>login_styles.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
	<section class="wrapper">
		<header>
			<?php include HEADER_TAGS ?>
		</header>
		<main id="main">
			<div class="form">
				<?php
					// Mnesaje para indicar que es neceario inciar sesion 
					if (isset($_GET['needed']) && $_GET['needed'] === 'true') {
					 	echo '
			 				<div class="error mensaje_needed">
								<span></span>
								<p>Necesitas iniciar sesion para entrar en esta pagina</p>
								<span><i class="icono fa fa-times" aria-hidden="true"></i></span>
							</div>';
					 }

					 // Mensaje para indicar cualquier error
					 if (isset($_GET['error']) && isset($_GET['message'])) {
					 	
					 	$search = array('<','>','/','<script>','</script>','<h2>','</h2>',';','*','/*','*/','-','_');

					 	$message = str_replace($search, ' ' , $_GET['message']);

					 	echo '
					 		<div class="error mensaje_needed">
								<span></span>
								<p>'.$message.'</p>
								<span><i class="icono fa fa-times" aria-hidden="true"></i></span>
							</div>';

					 }
				 ?>
 				<div class="facebook_btn" id="facebook_btn_wrap">
					<?php include 'core/facebook/facebook_login_url.php'; ?>
				</div>
				<div class="mensaje" id="mensaje_wrap">
					<span><i class="icon fa fa-refresh" aria-hidden="true"></i></span>
					<p id="msj_text">Esto es un mensaje</p>
					<span></span>
				</div>
				<form method="POST" enctype="application/x-www-form-urlencoded">
					<div class="email">
						<label for="email" class="" id="email_label">Email</label>
						<input type="email" name="email" id="email" placeholder="Email">
					</div>
					<div class="pass">
						<label for="pass" id="password_label">Contraseña</label>
						<input type="password" name="pass" id="pass" placeholder="Contraseña">
					</div>
					<div class="lost_password">
						<a href="Recuperar-contrasena">¿Olvidaste tu contraseña?</a>
					</div>
					<input type="button" value="Iniciar sesion" id="btn">
				</form>
			</div>
		</main>
		<footer>
			<?php include FOOTER_TAGS ?>
		</footer>
	</section>
	<script src="<?php echo JS_URL ?>login_conexion.js"></script>
	<?php include JS_SCRIPTS ?>
	<script>
		(function () {
		
			var icon = $('.icono');
			var wrap = $('.mensaje_needed');
			icon.on('click',function () {
				wrap.slideUp();
			});
		}());
	</script>
</body>
</html>