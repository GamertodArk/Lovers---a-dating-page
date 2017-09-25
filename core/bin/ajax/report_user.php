<?php 
	
	$db = new Conexion();
	
	// Escapamos los campos solo para estar seguros
	$user_id = $db->real_escape_string($objeto['user_id']);
	$message = $db->real_escape_string($objeto['message']);

	// Nuestro id
	$our_id = $_SESSION['user_id'];

	// Insertamos el reporte en la base de datos
	$db->query("INSERT INTO reportes (usuario_reportado,usuario_reportador,motivo_reporte) 
	VALUES ($user_id,$our_id,'$message') ;");

	// Mandamos la señal de que todo estubo bien
	echo 'success';


	$db->close();

?>