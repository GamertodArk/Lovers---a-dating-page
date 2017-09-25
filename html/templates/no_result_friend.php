<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - No se encontraron resultados</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>no_result_friend.css">
</head>
<body>
	<?php include FB_JS_SDK; ?>
		<section class="wrapper">
			<header>
				<?php include HEADER_TAGS ?>
			</header>
			<main id="main">
				<div class="wrap">
					<?php  
						// Escapamos unos cuantos caracteres por un poquito mas de seguridad
						$caracteres = array('<','>','/','!','-','?','php','--','<script>','</script>','%','+','"',"'",'\\','$','script','(',')');
						
						$search = str_replace($caracteres, ' ', $search);
					?>
					<h1>No se encontraron resultados</h1>
					<p>Lo sentimos, no hemos podido encontrar resultados para: <?php echo $search; ?></p>
				</div>
			</main>
			<footer>
				<?php include FOOTER_TAGS ?>
			</footer>
		</section>
	<?php include JS_SCRIPTS; ?>
</body>
</html>