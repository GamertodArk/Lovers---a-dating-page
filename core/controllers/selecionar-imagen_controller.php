<?php 
	if (isset($_SESSION['user_id'])) {

		include TEMP_URL .  'select_picture.php';

	} else {
		header('location: home');
	}
?>