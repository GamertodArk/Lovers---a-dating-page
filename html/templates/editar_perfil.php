<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Editar perfil</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>editar_perfil_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<div class="wrap">
					<div class="img">
						<img src="<?php echo $img;?>" alt="<?php echo $fullName ?>" title="<?php echo $fullName ?>">
						<a href="selecionar-imagen">Cambiar foto de perfil</a>
					</div>
					<form action="" method="POST" enctype="application/x-www-form-urlencoded" id="update_form">
						<div class="datos">
							<!-- Nombre y apellido -->
							<div class="nombre">
								<div class="nombre_content">
									<label for="name" id="name_label">Nombre:</label>
									<input type="text" name="name" id="name" placeholder="Nombre" value="<?php echo $name ?>">
								</div>
								<div class="apellido_content">
									<label for="last" id="apellido_label">Apellido:</label>
									<input type="text" name="last" id="last" placeholder="Apellido" value="<?php echo $last_name ?>">
								</div>
							</div>

							<!-- Fecha de nacimiento -->
							<div class="nacimientoFecha">
								<p id="nacimiento_label">Fecha de nacimiento:</p>
								<div class="nacimiento_inputs">
									<input type="number" name="dB" id="dB" min="01" max="31">
									<p>/</p>
									<input type="number" name="mB" id="mB" min="1" max="12">
									<p>/</p>
									<input type="number" name="yB" id="yB" min="1900" max="<?php echo date('Y') - 16; ?>">
								</div>
							</div>

							<!-- Genero -->
							<div class="genero">
								<label for="gender" id="genero_label">Genero:</label>
								<select name="gender" id="gender" form="update_form">
									<option value="Hombre">Hombre</option>
									<option value="Mujer">Mujer</option>
								</select>
							</div>

							<!-- Interes -->
							<div class="interes">
								<label for="interes" id="interes_label">Interes:</label>
								<select name="interes" id="interes" form="update_form">
									<option value="Hombres">Hombres</option>
									<option value="Mujeres">Mujeres</option>
									<option value="Ambos">Ambos</option>
								</select>
							</div>

							<!-- Pais -->
							<div class="pais">
								<label for="pais" id="pais_label">Pais:</label>
								<select name="pais" id="pais" form="update_form">
									<option value="Venezuela">Venezuela</option>
									<option value="Colombia">Colombia</option>
									<option value="Mexico">Mexico</option>
									<option value="`Pais cualquiera">Pais cualquiera</option>
									<option value="`Pais cualquiera">Pais cualquiera</option>
									<option value="`Pais cualquiera">Pais cualquiera</option>
									<option value="`Pais cualquiera">Pais cualquiera</option>
								</select>
							</div>

							<!-- Description -->
							<div class="descripcion">
								<label for="descripcion" id="descripcion_label">Descripcion:</label>
								<textarea name="descripcion" id="descripcion" form="update_form"><?php if ($descripcion == 'NULL') {echo '';}else {echo $descripcion;} ?></textarea>
							</div>

							<!-- Boton -->
							<button onclick="send(); return false;">
								<p id="botton_text">Enviar</p>
								<span class="hide" id="span_icon"><i id="refresh_icon" class="icon fa fa-refresh girar" aria-hidden="true"></i></span>
							</button>
						</div>
					</form>
				</div>
			</main>
			<footer>
				<?php FOOTER_TAGS ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>update_perfil.js"></script>
	<?php include JS_SCRIPTS; ?>
</body>
</html>