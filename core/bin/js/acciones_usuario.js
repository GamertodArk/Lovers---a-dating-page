
// Funcion para eliminar un usuario
// Recibe como parametro el id del usuario a eliminar
function delete_user(id) {
	// Nodos del dom utilizados por esta funcion
	var	span_del_button = document.getElementById('span_del_button'),
		del_button_text = document.getElementById('del_button_text');


	// Creamos el objeto json para enviarlo al servidor
	var json = {
		"type" 	  : "delete_user",
		"user_id" : id
	};


	// Lo preparamos para enviarlo con ajax
	var data = 'objeto=' + JSON.stringify(json);


	//Iniciamos la conexion con ajax
	var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveOXbject('Microsoft.XMLHTTP');
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4 && ajax.status === 200) {
			if (ajax.responseText == 'success' ) {

				// 	Mostramos el texto del boton y ocultamos el icono de carga
				del_button_text.classList.add('hide');
				span_del_button.classList.remove('hide');

				// Como el usuario sera eliminado redireccionamos al admin a la pagina del front
				window.location = 'front';
			}else {
				console.log(ajax.responseText);
			}
		}else {

			// Ocultamos el texto del boton y mostramos el icono del carga
			// Ocultamos
			del_button_text.classList.add('hide');
			span_del_button.classList.remove('hide');
		}
	}
	ajax.open('POST', 'ajax.php');
	ajax.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
	ajax.send(data);
}



// Esta funcion sirve para hacer administradores a los usaurios y recive como parametro el id del usaurio a convertir
function upgrade(id) {
	// Nodos de dom a utilizar
	var	mensaje = document.getElementById('mensaje'),
	    adm_text_button = document.getElementById('adm_text_button'),
		span_adm_button = document.getElementById('span_adm_button');

	
	//Objeto json a ser enviado para el servidor
	var json = {
		"type" : 'upgrade_user',
		"id"   : id
	};


	// Lo preparamos para enviarlo con ajax
	var data = 'objeto=' + JSON.stringify(json);


	// Iniciamos el objeto ajax
	var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveOXbject('Microsoft.XMLHTTP');
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4 && ajax.status === 200) {
			if (ajax.responseText == 'success' ) {

				// 	Mostramos el texto del boton y ocultamos el icono de carga
				span_adm_button.classList.add('hide');
				adm_text_button.classList.remove('hide');

				// Mostramos el mensaje de exito
				mensaje.classList.remove('hide');
			}
		}else {

			// Ocultamos el texto del boton y mostramos el icono de carga
			adm_text_button.classList.add('hide');
			span_adm_button.classList.remove('hide')
		}
	}
	ajax.open('POST', 'ajax.php');
	ajax.setRequestHeader("Content-Type", 'application/x-www-form-urlencoded');
	ajax.send(data);
}