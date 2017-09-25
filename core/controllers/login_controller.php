<?php 
	if (! isset($_SESSION['user_id'])) {
		
		include TEMP_URL . 'login.php';
	}else {
		header('location: front');
	}
 ?>