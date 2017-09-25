<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Acciones de administrador</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>acciones_usuario_styles.css"> 
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS; ?>
			</header>
			<main id="main">
				<section class="wrap">
					<div id="mensaje" class="hide mensaje">
						<p>Este usuario ahora es administrador</p>
					</div>
					<div class="img">
						<a href="perfil?id=<?php echo $id ?>"><img src="<?php echo $img ?>" alt="<?php echo $name ?>" title="<?php echo $name ?>"></a>
						<h2><?php echo $name ?></h2>
					</div>
					<div class="acciones">
						<button onclick="delete_user(<?php echo $id ?>)">
							<p id="del_button_text">Eliminar usaurio</p>
							<span class="hide" id="span_del_button"><i id="icon" class=" girar fa fa-refresh" aria-hidden="true"></i></span>
						</button>
						<button onclick="upgrade(<?php echo $id ?>)">
							<p id="adm_text_button">Hacer administrador</p>
							<span class="hide" id="span_adm_button"><i id="icon" class=" girar fa fa-refresh" aria-hidden="true"></i></span>
						</button>
					</div>
				</section>
			</main>
			<footer>
				<?php include FOOTER_TAGS; ?>
			</footer>
		</section>
	<script src="<?php echo JS_URL ?>acciones_usuario.js"></script>
	<?php include JS_SCRIPTS; ?>
</body>
</html>