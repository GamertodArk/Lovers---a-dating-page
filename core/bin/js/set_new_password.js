
function go_ajax() {
	
	var pass1 = document.getElementById('password'),
		pass2 = document.getElementById('password_r'),
		msj_text = document.getElementById('msj_text'),
		message_wrap = document.getElementById('message_wrap'),
		password_form = document.getElementById('password_form'),
		mensaje_exito = document.getElementById('mensaje_exito'),
		password_label = document.getElementById('password_label'),
		password_r_label = document.getElementById('password_r_label');


		// array para almacenar lor permisos
		var permisos = [];

		// Comprobamos el passoword
		if (pass1.value != '') {

			permisos.push('password_success');
			password_label.classList.remove('error_empty');
		}else {
			password_label.classList.add('error_empty');
		}

		// Comprobamos el password_r
		if (pass2.value != '') {

			permisos.push('password_r_success');
			password_r_label.classList.remove('error_empty');
		}else {
			password_r_label.classList.add('error_empty');
		}

		


		// Comprobamos que todos los permisos fueron dados y iniciamos la conexion con ajax
		if (permisos.length  === 2) {

			// Comprobamos que las contreseñas sean iguales
			if (pass1.value === pass2.value) {

				// creamos el objeto json para enviarlo al servidor
				var json = {
					"type" 	   : "new_pass",
					"password" :  pass2.value
				};
				var data = 'objeto=' + JSON.stringify(json);

				// Iniciamos la conexion con ajax
				var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				ajax.onreadystatechange = function () {
					if (ajax.readyState === 4 && ajax.status === 200) {

						if (ajax.responseText === 'success') {

							// Ocultamos el mensaje
							message_wrap.classList.remove('error');
							message_wrap.classList.remove('loading');
							message_wrap.classList.add('message');

							// Ocultamos el form
							password_form.style.display = 'none';



							// Mostramos el mensaje de exito
							mensaje_exito.classList.remove('message');
							mensaje_exito.classList.add('successfully_change');
						}else{
							// Mostramos cualquier error de php
							console.log(ajax.responseText);
						}

					}else {
						// Mensaje de espera
						message_wrap.classList.remove('message');
						message_wrap.classList.remove('error');
						message_wrap.classList.add('loading');
						msj_text.innerHTML = 'Espere unos momentos...';					
					}
				}
				ajax.open('POST', 'ajax.php');
				ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				ajax.send(data);
			}else {
				// Mensaje de errro para cuendo las contraseñas no coincidan
				message_wrap.classList.remove('message');
				message_wrap.classList.remove('loading');
				message_wrap.classList.add('error');
				msj_text.innerHTML = 'Las contraseñas no coinciden';		
			}
		}else {
			// Mensaje de error cuando los campos esten vacios
			message_wrap.classList.remove('message');
			message_wrap.classList.remove('loading');
			message_wrap.classList.add('error');
			msj_text.innerHTML = 'Tienes que rellenar todos los campos';
		}
}

function go(e) {
	if (e.keyCode == 13) {
		go_ajax();
	}
}