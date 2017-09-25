
// Funcion para enviar el mensaje
function send_message(user_s,user_r) {
	var message = document.getElementById('message'),
		icon_span = document.getElementById('icon_span'),
		span_icon = document.getElementById('span_icon'),
		enviar_icon = document.getElementById('enviar_icon'),
		button_text = document.getElementById('button_text');

	// Objeto json para enviarlo al servidor
	var json = {
		"type"    : "send_message",
		"user_s"  : user_s,
		"user_r"  : user_r,
		"message" : message.value
	};

	// Lo preparamos para enviarlo con ajax
	var data = 'objeto=' + JSON.stringify(json);

	// Iniciamos la conexion con ajax
	var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4 && ajax.status === 200) {
			if (ajax.responseText == 'success') {
				// Se envio el mensaje correctamente

				// Ocultamos el icono y mostramos el texto
				button_text.classList.remove('hidden');
				enviar_icon.classList.add('hidden');

				// Limpiamos el campo del mensaje
				message.value = '';
			}else {
				// Mostramos cualquier error de php
				console.log(ajax.responseText);
			}
		}else {
			// Mostramos el icono de carga
			button_text.classList.add('hidden');
			enviar_icon.classList.remove('hidden');
			console.log(ajax.readyState);
		}
	}
	ajax.open('POST', 'ajax.php');
	ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
	ajax.send(data);

}

// Funcion para comprobar que el mensaje no sea demasiado largo
function message_length(event) {
	var input = document.getElementById('message');
	if (input.value.length >= 398) {
		input.classList.add('error_length');
	}else {
		input.classList.remove('error_length');
	}
}