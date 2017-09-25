// Nodos de dom

var	accion = document.getElementById('accion'),
	message = document.getElementById('message'),
	success = document.getElementById('success'),
	span_ico = document.getElementById('span_ico'),
	button_text = document.getElementById('button_text'),
	message_label = document.getElementById('message_label');


// Funcion para enviar la informacion mediante ajax
function send(id) {

	// Comprobamos que el campo no este vacio
	if (message.value !== '') {

		// Le quitamos lo rojo al label
		message_label.classList.remove('error_empty');

		// Creamos el objeto json para enviarlo al servidor
		var json = {
			"type"    : "report_user",
			"message" : message.value,
			"user_id" : id
		};

		// Preparamos el objeto json para enviarlo mediante ajax
		var data = 'objeto=' + JSON.stringify(json);


		// Iniciamos la conexion con ajax
		var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObjet('Microsoft.XMLHTTP');
		ajax.onreadystatechange = function () {
			if (ajax.readyState === 4 && ajax.status === 200) {

				// Comprobamos que todo salio bien en el servidor
				if (ajax.responseText === 'success') {
					
					// Ocultamos el formulario de envio y mostramos el mensaje de exito
					accion.classList.add('hidden');
					success.classList.remove('hidden');

				}else {
					console.log(ajax.responseText);
				}

			}else {
				// Ocultamos el texto del boton y mostramos el icono de carga
				button_text.classList.add('hidden');
				span_ico.classList.remove('hidden');
			}
		}
		ajax.open('POST', 'ajax.php');
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajax.send(data);

	}else {

		// Ponemos en rojo el label
		message_label.classList.add('error_empty');

	}
}


// Funcion para enviar el formulario con la tecla enter
function send_key(e,id) {
	if (e.keyCode == 13) {
		send(id);
	}
}