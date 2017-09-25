<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Lovers - Encuentra tu amor ideal!</title>
	<?php include HEAD_TAGS; ?>
	<link rel="stylesheet" href="<?php echo CSS_URL ?>front_styles.css">
</head>
<body>
	<?php include FB_JS_SDK ?>
	<section class="wrapper">
		<header>
			<?php include HEADER_TAGS ?>
		</header>
		<main id="main">
			<div class="form">
				<form action="search-friends" method="GET" id="search_form">
					<input type="text" name="search" id="search" placeholder="Buscar">
					<button type="submit" id="btn_search" onclick="var search = document.getElementById('search');if (search.value === '') {return false;}"><i class="fa fa-search" aria-hidden="true"></i></button>
				</form>
			</div>
			<script>
			</script>
			<?php 
				// Mensaje para indicar cualquier cosa
				if (isset($_GET['class']) && isset($_GET['content'])) {

					// Arrays para eviar las inyeciones javascript
					$search = array('<','>','/','php','script','<script>','</script>','-','.','%'); 

					$content = replace($search,' ',$_GET['content']);

					// Esto es para evitar inyecciones en la clase
					$search_class = array('"','(','=',')','//','--','/','*','!','@');

					$class = replace($search_class,' ', $_GET['class']);

					echo '
						<div class="mensaje ' . $class .'">
							<span></span>
							<p> ' . $content . ' </p>
							<span><i id="close_btn" class="fa  fa-times" aria-hidden="true"></i></span>
						</div>';
				}
			?>
			<div class="middle">
				<div class="find">
					<h3>¿No tienes pareja todavia?</h3>
					<p>¿A que esperas?, empieza a buscar pareja ahora mismo!</p>
					<a href="search-friends">Empezar a buscar</a>
				</div>
				<div class="amigos">
					<h3>Amigos Recientes</h3>
					<div class="amigos_list">
						<?php

							if (false != $amigos) {
								for ($i = 0; $i < count($amigos) ; $i++) {
									
									//Metemos los datos de los usuarios en varibles mas cortas para hacer el codigo mas legible 
									$id_amigo = $amigos[$i][0];
									$img_amigo = IMG_URL . $_usuarios[$id_amigo]['profile_img'];
									$nombre_amigo = $_usuarios[$id_amigo]['nombre'] . ' ' . $_usuarios[$id_amigo]['apellido'];
									$link_amigo = 'perfil?id=' . $id_amigo; 

									echo '
										<div>
											<img src=" ' . $img_amigo . ' " alt=" ' . $nombre_amigo . ' " title="' . $nombre_amigo . '" href=" ' .$link_amigo. ' ">
											<a href=" ' . $link_amigo . ' ">'. $nombre_amigo .'</a>
										</div>';
								 }
							}else {
								echo '<h2 class="empty_friend">No tienes amigos todavia</h2>';
							}
						 ?>
 					</div>
				</div>
			</div>
			<div class="hope">
				<h2>¿Todavia sin pareja?</h2>
				<p>Nuncas te rindas al intentar buscar pareja, recuerda que si vale la pena, cuesta</p>
			</div>
		</main>
		<footer>
			<?php include FOOTER_TAGS ?>
		</footer>
	</section>
	<?php include JS_SCRIPTS ?>
	<script>
		var mensaje_wrap = $('.mensaje');
		var btn = $('#close_btn');

		btn.on('click',function () {
			mensaje_wrap.slideUp();
		});
	</script>
</body>
</html>