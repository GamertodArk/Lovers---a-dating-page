<?php
	
	unset($_SESSION['user_id'],$_SESSION['facebook_access_token']);
	header('location: home');

?>