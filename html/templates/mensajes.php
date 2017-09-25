<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Mensajes</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>mensajes_styles.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<div class="wrap">
					<div class="titulo">
						<img src="<?php echo IMG_URL . $user_img ?>" alt="<?php echo $user_name ?>" title="<?php echo $user_name ?>">
						<h2><?php echo $user_name ?> - Mensajes</h2>
					</div>
					<hr>
					<div class="mensajes_wrapper">
						<?php 
							// Comprobamos que el usaurio haya enviado algun mensaje
							if (false != $mensajes) {
								
								for ($i = 0; $i < count($mensajes) ; $i++) { 

									// Codigo en varibales para hacer el codigo mas legible
									$name = $_usuarios[$mensajes[$i]['user_s']]['nombre'] . ' ' .$_usuarios[$mensajes[$i]['user_s']]['apellido'];
									$id_user_message = $mensajes[$i]['user_s'];
									$img = IMG_URL . $_usuarios[$mensajes[$i]['user_s']]['profile_img'];
									$mensaje = $mensajes[$i]['mensaje'];

									// Si nosotros enviamos el mensaje
									if ($mensajes[$i]['user_s'] === $_SESSION['user_id'] ) {
										
										// Mensaje enviado por nosotros 
										echo '
										<div class="mensajes_wrap_reverse">
											<img src="' . $img .'" alt="'. $name .'" title="'. $name .'">
											<div class="mensaje">
												<a href="perfil?id='. $id_user_message .'">'. $name .'</a>
												<p> ' . $mensaje . ' </p>
											</div>
										</div>';

									}elseif ($mensajes[$i]['user_s'] === $id) {
										// Mensaje enviado por el otro usuario
										echo '
										<div class="mensajes_wrap">
											<img src="' . $img .'" alt="'. $name .'" title="'. $name .'">
											<div class="mensaje">
												<a href="perfil?id='. $id_user_message .'">'. $name .'</a>
												<p> ' . $mensaje . ' </p>
											</div>
										</div>';
									}
								}

							}
						?>
					</div>
					<div class="send_message_wrap">
						<form id="message_form" onkeydown="message_length(event)">
							<textarea  maxlength="400" form="message_form" name="message" id="message" placeholder="Mensaje"></textarea>
							<button onclick="var input_empty_test = document.getElementById('message');if (input_empty_test.value == '') {return false;}else {send_message(<?php echo $_SESSION['user_id'] . ',' . $id; ?>); return false;}">
								<p id="button_text" >Enviar</p>
								<i id="enviar_icon" class="icon girar hidden fa fa-refresh" aria-hidden="true"></i>
							</button>
						</form>
					</div>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>send_message.js"></script>
	<?php include JS_SCRIPTS; ?>
</body>
</html>

<script>

</script>