<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Mensajes</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>usuarios_mensaje_lista_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>	
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS; ?>
			</header>
			<main id="main">
				<div class="wrap">
					<h1>Mensajes</h1>
					<hr>
					<div class="mensajes_wrapper">
						<?php 
							if (false != $users) {
								// Creamos un nuevo array para meter los id de los usuarios que vengan
								$id_usuarios = [];

								// Con este for hacemos que los valores intrducidos no se repitan
								for ($i=0; $i < count($users) ; $i++) { 
									// Si el valor ya esta en dentro del array pasa a la siguiente iteracion
									if ( in_array($users[$i][0], $id_usuarios) ) {
										continue;
									}else {
										// Si no lo esta lo metes en el nuevo array
										$id_usuarios[] = $users[$i][0];
									}
								}


								// Empezamos a mostrar los usuarios
								for ($i=0; $i < count($id_usuarios) ; $i++) { 
									
									//Metemos los datos en el array para hacer el codigo mas legible
									$lista_user_id = $id_usuarios[$i];
									$lista_user_name = $_usuarios[$lista_user_id]['nombre'] . ' ' . $_usuarios[$lista_user_id]['apellido'];
									$lista_user_img = IMG_URL . $_usuarios[$lista_user_id]['profile_img'];
									$lista_user_url = 'mensajes?id=' . $lista_user_id;
									

									// Los ultimos mensajes envidos por el usuario
									$user_id = $_SESSION['user_id'];
									$sql_s = $db->query("SELECT mensaje,hora FROM mensajes WHERE user_s = '$lista_user_id' AND user_r = '$user_id' OR user_s = '$user_id' AND user_r = '$lista_user_id' ORDER BY hora DESC LIMIT 1 ;");

									// Metemos los datos devueltos por la sql en un array
									$mensaje_data = $db->recorrer($sql_s);

									// Mostramos el usuario
									echo '		
									<div class="user_message">
										<div class="data">
											<a href="'. $lista_user_url .'"><img src="'. $lista_user_img .'" alt="'. $lista_user_name .'" title="'. $lista_user_name .'"></a>
											<div class="data_text">
												<a href="'. $lista_user_url .'">'. $lista_user_name .'</a>
												<p>'. $mensaje_data['hora'] .'</p>
											</div>
										</div>
										<div class="message">
											<p>'. $mensaje_data['mensaje'] .'</p>
										</div>
									</div>'; 

									// Liberamos la memoria ocupada por la sql
									$db->liberar($sql_s);
								}


							}else {
								echo '<h1>No tienes mensajes</h1>';
							}
						?>
					</div>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS; ?>
			</footer>
		</section>
	<?php include JS_SCRIPTS; ?>
</body>
</html>