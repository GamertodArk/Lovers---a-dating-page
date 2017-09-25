(function () {

	// labels
	var name_label = document.getElementById('name_label'),
		pais_label = document.getElementById('pais_label'),
		email_label = document.getElementById('email_label'),
		gender_label = document.getElementById('gender_label'),
		interes_label = document.getElementById('interes_label'),
		lastName_label = document.getElementById('lastName_label'),
		terminos_label = document.getElementById('terminos_label'),
		password_label = document.getElementById('password_label'),
		password_r_label = document.getElementById('password_r_label'),
		nacimiento_label = document.getElementById('nacimiento_label');

	// inputs
	var name = document.getElementById('name'),
		pais = document.getElementById('pais'),
		email = document.getElementById('email'),
		gender = document.getElementById('gender'),
		interes = document.getElementById('interes'),
		lastName = document.getElementById('apellido'),
		password = document.getElementById('password'),
		terminos = document.getElementById('terminos'),
		password_r = document.getElementById('password_r');

		//fecha de nacimiento
	var day = document.getElementById('dB'),
		year = document.getElementById('aB')
		month = document.getElementById('mB');


	var boton = document.getElementById('btn'),
		msj_text = document.getElementById('msj_text'),
		fb_btn_wrap = document.getElementById('fb_btn_wrap'),
		mensaje_wrap = document.getElementById('mensaje_wrap');


	boton.addEventListener('click',function () {

	// comprobaciones
	var permisos = [];

	// nombre
	if (name.value !== '') {
		permisos.push('name_success');
		name_label.classList.remove('empty');
	}else {
		name_label.classList.add('empty');
	}

	// apellido
	if (lastName.value !== '') {
		permisos.push('lastName_success');
		lastName_label.classList.remove('empty');
	}else {
		lastName_label.classList.add('empty');
	}

	// Email
	if (email.value !== '') {
		permisos.push('email_success');
		email_label.classList.remove('empty');
	}else {
		email_label.classList.add('empty');
	}

	// Contraseña
	if (password.value !== '') {
		permisos.push('password_success');
		password_label.classList.remove('empty');
	}else {
		password_label.classList.add('empty');
	}

	// Confirmacion de contraseña
	if (password_r.value !== '') {
		permisos.push('password_r_success');
		password_r_label.classList.remove('empty');
	}else {
		password_r_label.classList.add('empty');
	}

	// Fecha de nacimiento
	if (day.value !== '' && month.value !== '' & year.value !== '') {
		permisos.push('birthday_success');
		nacimiento_label.classList.remove('empty');
	}else {
		nacimiento_label.classList.add('empty');
	}

	// comprobamos que todos los permisos fueron concedidos perfectemante
	if (permisos.length === 6) {
		
		// comprobamos que aceptó los terminos y condiciones de uso
		if (terminos.checked) {
			
			// comprobamos que las contraseñas sean iguales
			if (password.value === password_r.value) {

				password_label.classList.remove('empty');
				password_r_label.classList.remove('empty');

				// creamos el objeto json para enviar los datos al servidor
				var json = {
					"type"     : "signup",
					"email"    : email.value,
					"name"	   : name.value,
					"lastName" : lastName.value,
					"password" : password.value,
					"genero"   : gender.value,
					"interes"  : interes.value,
					"pais"	   : pais.value,
					"birthday_date" : {
						"day"   : day.value,
						"month" : month.value,
						"year"  : year.value
					}
				};

				var data = 'objeto=' + JSON.stringify(json);

				//Iniciamos la conexion con ajax
				var connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
				connect.onreadystatechange = function () {
					
					if (connect.readyState === 4 && connect.status === 200) {
						if (connect.responseText === 'success') {

							// codigo para cuando todo este exelente
							fb_btn_wrap.style.display = 'none';
							mensaje_wrap.classList.remove('loading');		
							mensaje_wrap.classList.remove('error');
							mensaje_wrap.classList.add('success');
							msj_text.innerHTML = 'Todo listo... Espere unos momentos';	
							window.location = 'front?class=success&content=Felicidades,-te-has-registrado-correctamente,-hemos-enviado-un-correo-electronico-a-la-direccion-que-nos-diste-para-confirmar-que-es-tuya,-lo-unico-que-tienes-que-hacer-es-dar-click-en-el-enlace-que-te-hemos-enviado-y-todo-estara-listo';
						}else {
							console.log(connect.responseText);

							//Convertirmos el objeto json recibido desde el servidor 
							var respuesta = JSON.parse(connect.responseText);
							fb_btn_wrap.style.display = 'none';
							mensaje_wrap.classList.remove('loading');		
							mensaje_wrap.classList.remove('success');
							mensaje_wrap.classList.remove('error');

							mensaje_wrap.classList.add(respuesta.class);
							msj_text.innerHTML = respuesta.mensaje;	
						}
					}else if (connect.readyState != 4) {

							fb_btn_wrap.style.display = 'none';
							mensaje_wrap.classList.remove('success');
							mensaje_wrap.classList.remove('error');						
							mensaje_wrap.classList.add('loading');

							msj_text.innerHTML = 'Estamos cargando tu informacion, por favor, espere unos momentos';			
					}

				}
				connect.open('POST','ajax.php');
				connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
				connect.send(data);
			}else {

				fb_btn_wrap.style.display = 'none';
				mensaje_wrap.classList.remove('loading');		
				mensaje_wrap.classList.remove('success');
				mensaje_wrap.classList.add('error');
				msj_text.innerHTML = 'Las contraseñas no coinciden';	

				password_label.classList.add('empty');
				password_r_label.classList.add('empty');			
			}
		}else {

			fb_btn_wrap.style.display = 'none';
			mensaje_wrap.classList.remove('loading');		
			mensaje_wrap.classList.remove('success');
			mensaje_wrap.classList.add('error');
			msj_text.innerHTML = 'Tines que aceptar los terminos y condiciones de uso';
		}
	}else {

		fb_btn_wrap.style.display = 'none';
		mensaje_wrap.classList.remove('loading');		
		mensaje_wrap.classList.remove('success');
		mensaje_wrap.classList.add('error');
		msj_text.innerHTML = 'Todos los campos deben de estar llenos';
	}
		

	});

}());