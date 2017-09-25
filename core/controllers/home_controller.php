<?php
	
	if (!isset($_SESSION['user_id'])) {
		
		include TEMP_URL . 'home.php';
	}else {
		header('location: front');
	}

?>