<?php 
	if (! isset($_SESSION['user_id'])) {
		
		if (! isset($_GET['ready'])) {
			include TEMP_URL . 'password_reg.php';
		}else {
			include TEMP_URL . 'password_ready.php';
		}

	}else {
		header('location: front');
	}
?>