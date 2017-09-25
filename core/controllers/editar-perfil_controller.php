<?php
	if (isset($_SESSION['user_id'])) {
		
		// Datos del usuario
		$id = $_SESSION['user_id'];
		$name = $_usuarios[$id]['nombre'];
		$last_name = $_usuarios[$id]['apellido'];
		$descripcion = $_usuarios[$id]['descripcion'];
		$img =  IMG_URL . $_usuarios[$id]['profile_img'];
		$fullName = $_usuarios[$id]['nombre'] . ' ' . $_usuarios[$id]['apellido']; 

		include TEMP_URL . 'editar_perfil.php';

	}else {
		header('location: home');
	}
?>