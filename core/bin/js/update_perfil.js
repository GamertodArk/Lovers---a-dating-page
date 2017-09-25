
// Nodos del dom

// Inputs
var	dB = document.getElementById('dB'),
	mB = document.getElementById('mB'),
	yB = document.getElementById('yB'),
	pais = document.getElementById('pais'),
	nombre = document.getElementById('name'),
	genero = document.getElementById('gender'),
	apellido = document.getElementById('last'),
	interes = document.getElementById('interes'),
	span_icon = document.getElementById('span_icon'),
	botton_text = document.getElementById('botton_text'),
	descrìpcion = document.getElementById('descrìpcion'),
	refresh_icon = document.getElementById('refresh_icon');

// Labels
var name_label = document.getElementById('name_label'),
	pais_label = document.getElementById('pais_label'),
	genero_label = document.getElementById('genero_label'),
	interes_label = document.getElementById('interes_label'),
	apellido_label = document.getElementById('apellido_label'),
	nacimiento_label = document.getElementById('nacimiento_label'),
	descrìpcion_label = document.getElementById('descrìpcion_label');

// Funcion para enviar los datos al servidor
function send() {
	
	// Array para los permisos
	var permisos = [];

	// Nombre
	if (nombre.value !== '') {
		permisos.push('nombre_success');
		name_label.classList.remove('error_empty');
	}else {
		name_label.classList.add('error_empty');
	}


	// Apellido
	if (apellido.value !== '') {
		permisos.push('apellido_success');
		apellido_label.classList.remove('error_empty');
	}else {
		apellido_label.classList.add('error_empty');
	}

	// Fecha de nacimiento
	if (dB.value != '' && mB.value != '' && yB.value != '')  {
		permisos.push('nacimiento_succcess');
		var fecha_nacimiento = dB.value + '/' + mB.value + '/' + yB.value;
		nacimiento_label.classList.remove('error_empty');
	}else {
		nacimiento_label.classList.add('error_empty');
	}

	// Genero 
	if (genero.value !== '') {
		permisos.push('genero_success');
		genero_label.classList.remove('error_empty');
	}else {
		genero_label.classList.add('error_empty');
	}


	// Inreres
	if (interes.value !== '') {
		permisos.push('interes_success');
		interes_label.classList.remove('error_empty');
	}else {
		interes_label.classList.add('error_empty');
	}

	// Pais
	if (pais.value !== '') {
		permisos.push('pais_success');
		pais_label.classList.remove('error_empty');
	}else {
		pais_label.classList.add('error_empty');
	}


	// Descripcion
	if (descripcion.value !== '') {
		var desc_value = descripcion.value;
	}else {
		var desc_value = 'NULL';
	}



	// Comprobamos que todos los permisos fueron dados
	if (permisos.length == 6) {

		// Creamos el objeto json con los datos para enviarlos al servidor
		var json = {
			"type"   : "update_perfil",
			"nombre" : nombre.value,
			"gender" : genero.value,
			"pais"   : pais.value,
			"apellido"  : apellido.value,
			"born_date" : fecha_nacimiento,
			"interes"   : interes.value,
			"descripcion"  : desc_value ,
			"user_born_year" : yB.value
		};

		// Lo preparamos para mandarlo con ajax
		var data = 'objeto=' + JSON.stringify(json);

		// Iniciamos la conexion al servidor con ajax
		var ajax = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		ajax.onreadystatechange = function () {
			if (ajax.readyState === 4 && ajax.status === 200) {
				if (ajax.responseText === 'success') {

					window.location = 'front';

				}else {	
					console.log(ajax.responseText);
					botton_text.classList.remove('hide');
					span_icon.classList.add('hide');
				}
			}else {
				// console.log(ajax.readyState);
				botton_text.classList.add('hide');
				span_icon.classList.remove('hide');
			}
		}
		ajax.open('POST','ajax.php');
		ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		ajax.send(data);

	}

}