<?php 
	if (isset($_GET['id']) && isset($_SESSION['user_id']) && $_GET['id'] != 0 && array_key_exists($_GET['id'], $_usuarios)) {

		$id = intval($_GET['id']);
		include TEMP_URL . 'perfil.php';

	}else {
		header('location: home');
	}	
?>