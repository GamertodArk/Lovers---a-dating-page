<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Registrarse</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>signup_styles.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
	<section class="wrapper">
		<header>
			<?php include HEADER_TAGS ?>
		</header>
		<main id="main">
			<div class="formulario">
				<?php 
					// Mensaje para indicar cualquier error 
					if (isset($_GET['error']) && isset($_GET['message'])) {
						
						$search = array('<','>','/','<script>','</script>','<h2>','</h2>',';','*','/*','*/','-','_',' ');

					 	$message = str_replace($search, ' ' , $_GET['message']);

					 	echo '
					 		<div class="error_get">
								<span></span>
								<p>'.$message.'</p>
								<span><i class="icono fa fa-times" aria-hidden="true"></i></span>
							</div>';
					}
				 ?>
				<!-- boton de facbook -->
				<div class="fb_btn" id="fb_btn_wrap">
					<?php include 'core/facebook/facebook_signup_url.php' ?>
				</div>
				<div class="mensaje" id="mensaje_wrap">
					<span><i class="icon fa fa-refresh" aria-hidden="true"></i></span>
					<p id="msj_text"></p>
					<span></span>
				</div>
				<form method="POST" id="login_form" enctype="application/x-www-form-urlencoded">
					<!-- Nombre -->
					<div class="nombre">
						<label for="name" id="name_label">Nombre:</label>
						<input type="text" name="name" id="name" placeholder="Nombre">
					</div>
					
					<!-- apellido -->
					<div class="apellido">
						<label for="apellido" id="lastName_label">Apellido:</label>
						<input type="text" name="lastName" id="apellido" placeholder="Apellido">
					</div>

					<!-- Email -->
					<div class="email">
						<label for="email" id="email_label">Email:</label>
						<input type="email" name="email" id="email" placeholder="Email" >
					</div>

					<!-- contraseña -->
					<div class="password">
						<label for="password" id="password_label">Contraseña:</label>
						<input type="password" name="password" id="password" placeholder="Contraseña">
					</div>

					<!-- repetir conreaseña -->
					<div class="password_r">
						<label for="password_r" id="password_r_label">Repita su contraseña:</label>
						<input type="password" name="password_r" id="password_r" placeholder="Repita su contraseña">
					</div>

					<!-- genro -->
					<div class="genero">
						<label for="gender" id="gender_label">Genero:</label>
						<select name="gender" id="gender" form="login_form" >
							<option value="Hombre">Hombre</option>
							<option value="Mujer">Mujer</option>
						</select>
					</div>

					<!-- Me interesan -->
					<div class="intereses">
						<label for="interes" id="interes_label">Me interesan:</label>
						<select name="interes" id="interes" form="login_form">
							<option value="Hombres">Hombres</option>
							<option value="Mujeres">Mujeres</option>
							<option value="Ambos">Ambos</option>
							<option value="Otros">Otros</option>
						</select>
					</div>
					<!-- fecha de nacimiento -->
					<div class="nacimientoFecha">
						<p id="nacimiento_label">Ingresa tu fecha de nacimiento:</p>
						<div class="inputs">
							<input type="number" name="dB" id="dB"  min="01" max="31">
							<p>/</p>
							<input type="number" name="mB" id="mB"  min="1" max="12">
							<p>/</p>
							<input type="number" name="aB" id="aB"  min="0" max="<?php echo date('Y') - 16; ?>">
						</div>
					</div>

					<!-- Pais de recidencia -->
						<div class="pais">
							<label for="pais" id="pais_label">Pais:</label>
							<select name="pais" id="pais" form="login_form">
								<option value="Venezuela">Venezuela</option>
								<option value="Colombia">Colombia</option>
								<option value="Mexico">Mexico</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
								<option value="Pais cualquiera">Pais cualquiera</option>
							</select>
						</div>

						<!-- Terminos y condiciones de uso -->
						<div class="term">
							<label for="terminos" id="terminos_label">
								<input type="checkbox" name="terminos" id="terminos" checked="" value="1">Acepto los terminos y condiciones de uso
							</label>
						</div>

					<!-- boton de registro -->
					<input type="button" value="Registrarse" id="btn">
				</form>
			</div>
		</main>
		<footer>
			<?php include FOOTER_TAGS ?>
		</footer>
	</section>
	<script src="<?php echo JS_URL ?>signup_conexion.js"></script>
	<?php include JS_SCRIPTS ?>
	<script>
		
		// Script para cerrar el mensaje que llega mendiante el metodo get
		var wrap_message_get = $('.error_get');
		var icon_get = $('.error_get .icono');

		icon_get.on('click',function () {
			
			wrap_message_get.slideUp();

		});

	</script>
</body>
</html>