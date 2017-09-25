<?php  
	if ( isset($_SESSION['user_id']) && isset($_GET['id']) && array_key_exists($_GET['id'], $_usuarios) && $_GET['id'] !== $_SESSION['user_id']) {
		
		// Metemos los datos en variables para hacer el codigo mas legible
		$id = intval($_GET['id']);
		$img = IMG_URL . $_usuarios[$_GET['id']]['profile_img'];
		$name = $_usuarios[$_GET['id']]['nombre'] . ' ' . $_usuarios[$_GET['id']]['apellido'];

		// Incluimos el template
		include TEMP_URL . 'user_report.php';

	}else {
		header('location: home');
	}
?>