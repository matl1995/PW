function validacion() {
	//Compruebo nombre
	var nombre = document.forms["registro"]["nombre"].value;
	if( nombre == null || nombre.length == 0 || /^\s+$/.test(nombre) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("El nombre no está rellenado correctamente");
		return false;
	}

	//Compruebo apellidos
	var apellidos = document.forms["registro"]["apellidos"].value;
	if( apellidos == null || apellidos.length == 0 || /^\s+$/.test(apellidos) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("Los apellidos no está rellenado correctamente");
		return false;
	}

	//Compruebo usuario
	var usuario = document.forms["registro"]["usuario"].value;
	if( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("El usuario no está rellenado correctamente");
		return false;
	}

	//Compruebo contraseña
	var contrasenia = document.forms["registro"]["contrasenia"].value;
	if( contrasenia == null || contrasenia.length < 8 || /^\s+$/.test(contrasenia)) { //Compruebo lo anterior y que tenga una longitud minima
		alert("La contraseña no está rellenado correctamente");
		return false;
	}

	//Compruebo la repeticion de contraseña
	var contrasenia2 = document.forms["registro"]["contrasenia2"].value;
	if(contrasenia2!=contrasenia) { //Compruebo que la segunda contraseña sea igual que la primera contraseña
		alert("La segunda contraseña no coincide con la primera");
		return false;
	}
		
	alert("El usuario ha sido registrado");				 
	return true;
}

function validacion1() {
	//Compruebo usuario
	var usuario = document.forms["inicio_sesion"]["usuario"].value;
	if( usuario == null || usuario.length == 0 || /^\s+$/.test(usuario) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("El usuario no está rellenado correctamente");
		return false;
	}

	//Compruebo contraseña
	var contrasenia = document.forms["inicio_sesion"]["contrasenia"].value;
	if( contrasenia == null || contrasenia.length < 8 || /^\s+$/.test(contrasenia)) { //Compruebo lo anterior y que tenga una longitud minima
		alert("La contraseña no está rellenado correctamente");
		return false;
	}
			
	alert("Los datos de inicio de sesion son correctos");			 
	return true;
}