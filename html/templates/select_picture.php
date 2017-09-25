<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Selecion de imagen de perfil</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>selecionar_imagen_styles.css">
</head>
<body>
	<?php include FB_JS_SDK;?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS; ?>
			</header>
			<main id="main">
				<div class="wrap">
					<?php 
						if (isset($_GET['message'])) {
							
							$remplazar = ['<','>','/','{','}','"',"'",'script','<script>','</script>','*','-','_',' '];
							$message = str_replace($remplazar, ' ' , $_GET['message']);

							echo '
							<div class="mensaje">
								<p>'. $message .'</p>
							</div>';
						}
					?>
					<form method="POST" action="imagen-datos" enctype="multipart/form-data">
						<div class="input">
							<p>Selecionar Imagen</p>
							<input type="file" name="file" id="file">
						</div>
						<input type="submit" value="Continuar" onclick="if (document.getElementById('file').value == '') {return false;}">
					</form>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<?php include JS_SCRIPTS; ?>
</body>
</html>