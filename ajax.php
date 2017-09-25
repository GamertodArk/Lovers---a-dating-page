<?php 
	// Este fichero se encarga de administrar todas las solicitudes echas mediante ajax

	require 'core/core.php';
	if ($_POST) {
		$objeto = json_decode($_POST['objeto'], true);
		
		switch ($objeto['type']) {

			// Inicio de sesion
			case 'login':
				include 'core/bin/ajax/login.php';
			break;
			
			// Registro
			case 'signup':
				include 'core/bin/ajax/signup.php';
			break;

			// Recuperar contraseña
			case 'rec_pass':
				include 'core/bin/ajax/rec_pass.php';
			break;

			// Escribir una nueva contraseña
			case 'new_pass':
				include 'core/bin/ajax/set_new_password.php';
			break;

			// Enviar solicitud de amistad
			case 'friend_request':
				include 'core/bin/ajax/friend_request.php';
			break;

			// Aceptar solicitud de amistad
			case 'aceptar_solicitud_amistad':
				include 'core/bin/ajax/aceptar_solicitud_amistad.php';
			break;

			// Enviar mensaje
			case 'send_message':
				include 'core/bin/ajax/send_message.php';
			break;

			// Editar perfil
			case 'update_perfil':
				include 'core/bin/ajax/update_perfil.php';
			break;

			// Reportar un usuario
			case 'report_user':
				include 'core/bin/ajax/report_user.php';
			break;
			
			// Eliminar usaurio
			case 'delete_user':
				include 'core/bin/ajax/delete_user.php';
			break;

			// Actualizar usaurio
			case 'upgrade_user':
				include 'core/bin/ajax/upgrade_user.php';
			break;

			default:
				header('location: home');	
			break;
		}
	}else {
		header('location: home');
	}

 ?>