<?php 
	// Comprobaciones para poder acceder al controller
	if (isset($_SESSION['user_id']) && isset($_GET['id']) && array_key_exists($_GET['id'], $_usuarios) && $_usuarios[$_SESSION['user_id']]['permisos'] > 0 && $_SESSION['user_id'] !== $_GET['id']) {
		
		$id = intval($_GET['id']);

		// Datos en variables para hacer el codigo mas legible
		$img = IMG_URL . $_usuarios[$id]['profile_img'];
		$name = $_usuarios[$id]['nombre'] . ' ' . $_usuarios[$id]['apellido'];

		// Incluimos el template
		include TEMP_URL . 'acciones_usuario.php';

	}else {
		header('location: home');
	}
?>