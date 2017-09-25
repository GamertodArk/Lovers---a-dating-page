<?php  
	$db = new Conexion();
		$password = sha1($objeto['password']);
		$id = $_SESSION['user_id_temporal'];
		$db->query("UPDATE usuarios SET password = '$password', password_rec_key = '' WHERE id = '$id' ;");
		unset($_SESSION['user_id_temporal']);
		echo 'success';
	$db->close();
?>