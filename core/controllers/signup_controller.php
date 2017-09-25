<?php 
	if (! isset($_SESSION['user_id'])) {
		include TEMP_URL . 'signup.php';
	}else {
		header('location: front');
	}
?>