<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Resltado encontrado</title>
	<?php include HEAD_TAGS ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>user_found_styles.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<?php  
					// Escapamos unos cuantos caracteres por un poquito mas de seguridad
					$caracteres = array('<','>','/','!','-','?','php','--','<script>','</script>','%','+','"',"'",'\\','$','script','(',')');
					
					$search = str_replace($caracteres, ' ', $search);
				?>
				<h2>Resultados para: <?php echo $search ?></h2>
				<hr>
				<div class="resultados">
					<?php  
						for ($i=0; $i < count($resultados) ; $i++) {

							// Metemos los datos de los usuarios en variables mas pequeñas para hacer el codigo mas legible
							$user_id = $resultados[$i][0];
							$user_img = IMG_URL . $_usuarios[$user_id]['profile_img'];
							$user_name = $_usuarios[$user_id]['nombre'] . ' ' . $_usuarios[$user_id]['apellido'];
							$user_genero = $_usuarios[$user_id]['genero'];
							$user_link = 'perfil?id=' . $user_id;

							// Evitamos ver nuestro propio usuario
							if ($user_id === $_SESSION['user_id']) {
								continue;
							}

							// Mostramos los resultados
							echo '
								<div class="user_resultados">
									<div class="right">
										<img src="'. $user_img .'" alt="'. $user_name .'" title="'. $user_name .'">
										<div class="data">
											<p>'.$user_name.'</p>
											<p>Genero: '. $user_genero .'</p>
										</div>
									</div>
									<a href="'. $user_link .'">Ver perfil</a>
								</div>';
						}
					?>
				</div>
 			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<?php include JS_SCRIPTS ?>
</body>
</html>