function ajax(user_s,user_r) {
	
	// Nodos necesarios
	var icon_prueba = document.getElementById('icon_' + user_s);
	var button_text = document.getElementById('button_text_' + user_s);
	

	// Creamos el json para enviarlo al servidor
	var json = {
		"type"   : "aceptar_solicitud_amistad",
		"user_s" : user_s,
		"user_r" : user_r 
	};

	// Lo preparamos para enviarlo mediante ajax
	var data = 'objeto=' + JSON.stringify(json);

	// iniciamos la conexion con ajax
	var ajax =  window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	ajax.onreadystatechange = function () {
		if (ajax.readyState === 4 && ajax.status === 200) {
			if (ajax.responseText === 'success') {
				button_text.classList.remove('hidden');
				icon_prueba.classList.remove('girar');
				icon_prueba.classList.add('hidden');

				button_text.innerHTML = 'Solicitud aceptada';				
			}else {
				console.log(ajax.responseText);
			}
		}else {
			button_text.classList.add('hidden');
			icon_prueba.classList.remove('hidden');
			icon_prueba.classList.add('girar');
		}
	}
	ajax.open('POST', 'ajax.php');
	ajax.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	ajax.send(data);
}