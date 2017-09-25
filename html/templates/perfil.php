<?php 
	// Metedos los datos en unas variables mas cortas para hacer el codigo mas legible
	$nombre = $_usuarios[$id]['nombre'] . ' ' . $_usuarios[$id]['apellido'];
	$img = IMG_URL . $_usuarios[$id]['profile_img'];
	$edad = $_usuarios[$id]['edad'];
	$interes = $_usuarios[$id]['interes'];
	$pais = $_usuarios[$id]['pais'];
	$genero = $_usuarios[$id]['genero'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - <?php echo $nombre ?> </title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL; ?>perfil_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
	<section class="wrapper">
		<header>
			<?php include HEADER_TAGS; ?>
		</header>
		<main id="main">
			<section class="wrap">
				<div class="img_perfil">
					<img src="<?php echo $img ?>" alt="Imagen de perfil de <?php echo $nombre ?>" title="<?php echo $nombre ?>">

					<h2 title="<?php echo $nombre ?>"><?php echo $nombre ?></h2>
				</div>
				<div class="acciones">
					<div class="content_acciones">
						<?php 
							// Si estoy viendo mi propio perfil
							if ($id == $_SESSION['user_id']) {
								echo '
								<a href="editar-perfil" >Editar perfil</a>
								<a href="amigos">Lista de amigos</a>
						   		<a href="mensajes">Lista de mensajes</a>';
							}else {
								// Cuando vemos el perfil de otro usuario comprobamos si somos administradores
								if ( ($_usuarios[$_SESSION['user_id']]['permisos'] > 0 && $_usuarios[$id]['permisos'] < 1)  OR $_usuarios[$_SESSION['user_id']]['permisos'] == 2) {
									// Si somos administradores añadimos un nuevo boton 'acciones'
									echo '
									<a href="reportar-usuario?id='.$id.'">Reportar</a>
									<a href="acciones-usuario?id='.$id.'">Acciones</a>
									<button id="friend_request_button"> 
										<p>Enviar solicitud</p>
										<span class="hidden" id="friend_request_loading_icon"><i id="icon" class="icon fa fa-refresh" aria-hidden="true"></i></span>
									</button>
  									<a href="mensajes?id='.$id.'">Enviar Mensaje</a>';
								}else {

									echo '
									<a href="reportar-usuario?id='.$id.'">Reportar</a>
									<button id="friend_request_button"> 
										<p id="friend_request_button_text">Enviar solicitud</p>
										<span class="hidden" id="friend_request_loading_icon"><i id="icon" class="icon fa fa-refresh" aria-hidden="true"></i></span>
									</button>
  									<a href="mensajes?id='.$id.'">Enviar Mensaje</a>';
								}
							}
						?>
					</div>
				</div>
				<div class="datos">
					<div class="up">
						<p>Edad: <?php echo $edad; ?></p>
						<p>Genero: <?php echo $genero ?></p>
						<p>Interes: <?php echo $interes; ?> </p>
						<p>Pais: <?php echo $pais; ?></p>
					</div>
					<?php 
						//Como no se le pidio una descripcion al usuario al momento de registrase, necesitamos verificar si lo ingreso al ediatr su perfil
						if (isset($_usuarios[$id]['descripcion']) && $_usuarios[$id]['descripcion'] !== '' && $_usuarios[$id]['descripcion'] !== 'NULL') {
							echo '
							<div class="down">
								<h3>Descripcion:</h3>
								<p>'. $_usuarios[$id]['descripcion'] .'</p>
							</div>';
						}
					?>
				</div>
			</section>
		</main>
		<footer>
			<?php include FOOTER_TAGS; ?>
		</footer>
	</section>
	<?php include JS_SCRIPTS ?>

	<!-- Script para enviar una solicitud de amistad -->
	<script>
		(function () {		
			// Usuario que envia la solicitud
			var user_s = <?php echo $_SESSION['user_id']; ?>;

			// Usuario que recibe la solicitud
			var user_r = <?php echo $id ?>;

			// Creamos el objeto json para enviarla al servidor
			var json = {
				"type"   : "friend_request",
				"user_s" : user_s,
				"user_r" : user_r
			};

			// Texto del boton
			var button_text = document.getElementById('friend_request_button_text');

			//icono del boton
			var button_icon = document.getElementById('icon');

			//span del icono
			var button_icon_span = document.getElementById('friend_request_loading_icon');


			// Lo preparamos para enviarlo con ajax
			var data = 'objeto=' + JSON.stringify(json);

			// preparamos el boton
			var boton = document.getElementById('friend_request_button');
			boton.addEventListener('click', function () {
			
				// Iniciamos la conexion con ajax
				var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				ajax.onreadystatechange = function () {
					if (ajax.readyState === 4 && ajax.status === 200) {

						if (ajax.responseText === 'success' || ajax.responseText === 'sent') {

							button_text.classList.remove('hidden');
							button_icon_span.classList.add('hidden');
							button_text.innerHTML = 'Solicitud Enviada';
						}else if (ajax.responseText === 'friends'){

							button_text.classList.remove('hidden');
							button_icon_span.classList.add('hidden');
							button_text.innerHTML = 'Amigos';							
						}else {
							console.log(ajax.responseText);
						}

					}else {
						button_text.classList.add('hidden');
						button_icon_span.classList.remove('hidden');
					}
				}
				ajax.open('POST','ajax.php');
				ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
				ajax.send(data);
			});
		}());
		

	</script>
</body>
</html>