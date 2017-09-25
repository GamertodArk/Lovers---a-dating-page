<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Amigos</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>amigos_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS; ?>
			</header>
			<main id="main">	
				<section class="wrap">
					<!-- Solicitudes de amistad -->
					<div class="solicitudes">
						<h2>Solicitudes de amistad</h2>
						<div class="content">
							<?php 
								if ($s_a) {
									
									for ($i=0; $i < count($datos) ; $i++) {

										//Metemos los datos en variables para hecer el codigo mas legible 
										$user_id = $datos[$i][0];
										$user_img = $_usuarios[$user_id]['profile_img'];
										$user_name = $_usuarios[$user_id]['nombre'] . ' ' . $_usuarios[$user_id]['apellido'];
										$user_genero = $_usuarios[$user_id]['genero'];

											// Mostramos el usuario
											echo '
											<div class="solicitud_content">
												<div class="pic_name">
													<img src="' .  IMG_URL . $user_img  .'" alt="'. $user_name .'" title="' . $user_name . '">
													<div class="user_data">
														<p>' . $user_name . '</p>
														<p>Genero: ' . $user_genero . '</p>
													</div>
												</div>
												<div class="boton"> 
														<button onclick="ajax('.$user_id .',' . $_SESSION['user_id'] .')">
														<p class="" id="button_text_'.$user_id.'">Aceptar Solicitud</p>
														<span class="" id="friend_request_loading_icon"><i id="icon_'.$user_id.'" class="icon hidden fa fa-refresh" aria-hidden="true"></i></span>
														</button>
													</div>
												</div>';										
									}

								}else {
									echo '<p class="empty">No tienes solicitudes de amistad</p>';
								}
							?>
						</div>
					</div>
					<!-- Amigos -->
					<div class="amigos">
						<h2>Amigos</h2>
						<div class="content">
							<?php 
								if ($a_a) {

									// Se puede dar el caso en el que sl mismo usuario aparezca en 2 iteraciones del ciclo, para evitar eso lo que hacemos es guardar el id de todo nuevo usuario que pase por la iteracion y si en una iteracion pasa un usuario cuya id ya esta en el array, saltamos a la siguiente iteracion
									$registro = [];

									//Empezamos a iterar cara uno de los amigos del usaurio
									for ($i=0; $i < count($amigos) ; $i++) { 

										/*
											La sql para amigos nos devolvia una solicitud de amistad que ya fue aceptada, lo que quiere decir que ya son amigos, con la sql para amigos lo que hacemos es que traemos el usuario que la envio y el usuario que la recivio, como no podemos estar 100% seguros de quien es quien desde la sql, por eso lo hacemos en php. Esto lo que hace es basicamente comprobar = Si el id del usuario que envio la solicitud es igual al de nosotros, eso quiere decir que nosotros fuimos los que enviamos la solicitud, por lo tanto almacenamos el id del usaurio que la recibio en una varibale para poder mostrar sus datos, si el id del usuario que envio la solicitud no es igual al de nosotros, eso quiere decir que nosotros fuimos los que recibimos esa solicitud de amistad, pos lo tanto almacenamos el id del usuario que la envio para poder mostrar sus datos
										*/ 
										if ($amigos[$i]['user_s'] == $_SESSION['user_id']) {
											$user_id = $amigos[$i]['user_r'];
										}else {
											$user_id = $amigos[$i]['user_s'];
										}
										

										// Metemos los datos en variables para hacer el codigo mas legible
										$amigos_user_id = $user_id;
										$amigos_user_img = IMG_URL . $_usuarios[$amigos_user_id]['profile_img'];
										$amigos_user_name = $_usuarios[$amigos_user_id]['nombre'] . ' ' . $_usuarios[$amigos_user_id]['apellido'];
										$amigos_user_genero = $_usuarios[$amigos_user_id]['genero'];
										$amigos_user_link = 'perfil?id=' . $amigos_user_id;

										// If para evitar la doble paracion del mismo usuario explicada arriba
										if (! in_array($amigos_user_id, $registro) ) {											

											// Añadimos el id del usuario al registro
											array_push($registro, $amigos_user_id);

											// Mostramos el usaurio
											echo '
											<div class="amigos_content">
												<div class="perfil">
													<img src="' . $amigos_user_img . '" alt="'. $amigos_user_name .'" title="'. $amigos_user_name .'">
													<div class="amigos_datos">
														<p>'. $amigos_user_name .'</p>
														<p>'. $amigos_user_genero .'</p>
													</div>
												</div>
												<div class="boton">
													<a href="'. $amigos_user_link .'">Ver perfil</a>
												</div>
											</div>';

										}else {
											continue;
										}

									}
								}else {
									// Si el usuario no tiene amigos
									echo '<p class="empty">No tienes amigos</p>';
								}
							?>
						</div>
					</div>
				</section>
			</main>
			<footer>
				<?php include FOOTER_TAGS; ?>
			</footer>
		</section>
	<script src=" <?php echo JS_URL ?>aceptar_solicitud_amistad.js"></script>
	<?php include JS_SCRIPTS; ?>
</body>
</html>