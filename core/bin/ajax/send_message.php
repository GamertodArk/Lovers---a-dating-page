<?php  
	if ($_POST) {
		
		$db = new Conexion();
		// Escapamos las variables para evitar la inyeccion sql
		$user_s = $db->real_escape_string($objeto['user_s']);
		$user_r = $db->real_escape_string($objeto['user_r']);
		$message = $db->real_escape_string($objeto['message']);

		// Hora a la que se envio el mensaje
		$hora = date('d/m/Y H:s');

		// Metemos los datos en la base de datos
		$db->query("INSERT INTO mensajes (user_s,user_r,mensaje,hora)
		VALUES ('$user_s','$user_r','$message','$hora')  ;");

		$db->close();

		// mandamos la señal de que todo esta bien
		echo 'success';

	}else {
		header('location: home');
	}
?>