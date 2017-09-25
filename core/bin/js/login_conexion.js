(function () {
	
	// traemos todos los nodos necesarios
	var btn = document.getElementById('btn'),
		email = document.getElementById('email'),
		password = document.getElementById('pass'),
		email_label  = document.getElementById('email_label'),
		password_label = document.getElementById('password_label'),
		facebook_btn_wrap = document.getElementById('facebook_btn_wrap'),
		mensaje_wrap = document.getElementById('mensaje_wrap'),
		msj_text = document.getElementById('msj_text');

	btn.addEventListener('click',function () {

		// creamos el array que almacenara los permisos
		var permisos = [];

		// comprovamos que el campo email no este vacio
		if (email.value != '') {
			permisos.push('email_success');
			email_label.classList.remove('empty');
		}else {
			email_label.classList.add('empty');
		}

		// comprovamos que el capo password no este vacio
		if (password.value != '') {
			permisos.push('password_success');
			password_label.classList.remove('empty');
		}else {
			password_label.classList.add('empty');
		}

		// comprovamos que todos los permisos fueron dados correctamente
		if (permisos.length < 2) {
			facebook_btn_wrap.style.display = 'none';
			mensaje_wrap.classList.add('error');
			msj_text.innerHTML = 'Tienes que rellenar todos los campos';			
		}else {

			// construimos el objeto json
			var json = {
				"type"     : "login",
				"email"    : email.value,
				"password" : password.value 
			};

			// convertimos el objeto json a string para poder enviarlo al servidor
			var data_info = JSON.stringify(json);

			// preparamos lo que le enviaremos atraves de ajax
			var data = 'objeto=' + data_info;

			// iniciamos la conexion con ajax
			var connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveObject('Microsonft.XMLHTTP');
			connect.onreadystatechange = function () {
				if (connect.readyState == 4 && connect.status == 200) {
					
					if (connect.responseText === 'success') {
						// todo en orden
						facebook_btn_wrap.style.display = 'none';
						mensaje_wrap.classList.remove('error');
						mensaje_wrap.classList.remove('loading');
						mensaje_wrap.classList.add('success');
						msj_text.innerHTML = 'Listo, te estamos redireccionando...';
						window.location = 'front';
					} else {
						
						var json_php = JSON.parse(connect.responseText);

						facebook_btn_wrap.style.display = 'none';
						mensaje_wrap.classList.remove('loading');
						mensaje_wrap.classList.remove('success');
						mensaje_wrap.classList.remove('error');
						
						mensaje_wrap.classList.add(json_php.class);						
						msj_text.innerHTML = json_php.mensaje;
					}

				}else if (connect.readyState != 4) {
					facebook_btn_wrap.style.display = 'none';
					mensaje_wrap.classList.remove('error');
					mensaje_wrap.classList.remove('success');
					mensaje_wrap.classList.add('loading');
					msj_text.innerHTML = 'Estamos comprobando tus datos...';								
				}
			}
			connect.open('POST', 'ajax.php' , true);
			connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			connect.send(data);


		}

	});

}());