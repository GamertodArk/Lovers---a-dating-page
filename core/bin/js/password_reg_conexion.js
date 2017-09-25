function go(e) {
	if (e.keyCode === 13) {
		ajax();
		return false;
	}
}

function ajax() {
	var email = document.getElementById('email'),
		mensaje_wrap = document.getElementById('message_wrap'),
		mensaje_text = document.getElementById('message_text');


	// Comprovamos que el email no este vacio en caso que borrara lo que esta dentro del onclick

	if (email.value !== '') {
		if (email.value.length < 50) {

			// Creamos el json para enviar al servidor
			var json = {
				"type"  : "rec_pass",
				"email" : email.value
			};
			
			// Lo convertimos a string
			var json_string = JSON.stringify(json);
				
			// Iniciamos la conexion con ajax
			var connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
			connect.onreadystatechange = function () {
				if (connect.readyState === 4 && connect.status === 200) {

					if (connect.responseText === 'success') {

						window.location = 'http://elvis.com:8085/projects/lovers/recuperar-contrasena?ready=true';

					}else {
						// Recibo el objeto json dado desde el servidor
						var object_json = JSON.parse(connect.responseText);
						
						// Utilizo los datos dados por el objero json
						mensaje_wrap.classList.remove('message');
						mensaje_wrap.classList.remove('error');
						mensaje_wrap.classList.remove('loading');
						mensaje_wrap.classList.add(object_json.class);
						message_text.innerHTML = object_json.message;					
					}

				}else {
					// Mostramos el mensaje de espera hasta que el objeto ajax termine su conexion
					mensaje_wrap.classList.remove('message');
					mensaje_wrap.classList.remove('error');
					mensaje_wrap.classList.add('loading');
					message_text.innerHTML = 'Espere unos momentos';						
				}
			}
			connect.open('POST','ajax.php', true);
			connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			connect.send('objeto=' + json_string);
		} else {
			// Mensaje para avisar de que el email es demasiado largo
			mensaje_wrap.classList.remove('message');
			mensaje_wrap.classList.remove('loading');
			mensaje_wrap.classList.add('error');
			message_text.innerHTML = 'Tu email es demasiado grande';						
		}
	}else {
		// Mensaje para avisar sobre el campo vacio
		mensaje_wrap.classList.remove('message');
		mensaje_wrap.classList.remove('loading');
		mensaje_wrap.classList.add('error');
		message_text.innerHTML = 'Tienes que ingresar una direccion de correo electronico';
	}


}