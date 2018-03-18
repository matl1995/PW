function validacion() {
	//Compruebo nombre
	var nombre = document.forms["modificacion"]["nombre"].value;
	if( nombre.length > 20 || /^\s+$/.test(nombre) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("El nombre no está rellenado correctamente");
		return false;
	}

	//Compruebo apellidos
	var apellidos = document.forms["modificacion"]["apellidos"].value;
	if( apellidos.length > 20 || /^\s+$/.test(apellidos) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("Los apellidos no está rellenado correctamente");
		return false;
	}

	//Compruebo usuario
	var usuario = document.forms["modificacion"]["usuario"].value;
	if( usuario.length > 10 || /^\s+$/.test(usuario) ) { //Compruebo que no este vacio o con muchos espacios en blanco
		alert("El usuario no está rellenado correctamente");
		return false;
	}

	//Compruebo el email
	var email = document.forms["modificacion"]["email"].value;
    if (!(/^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/.test(email)) && email.length!=0 ) { //Cmpruebo que antes del @ hay contenido, que hay direccion antes del punto, y mas de 2 caracteres despues del punto
        alert("La direccion de email no es valida");
        return false;
    }

    //Compruebo el telefono
	var telefono = document.forms["modificacion"]["telefono"].value;
	if( telefono.length!=0 && (!(/^([9,7,6]{1})+([0-9]{8})$/.test(telefono)) || telefono.length>9)) //compruebo que el primer numero es 6,7 o 9 y que despues solo haya otros 8 numeros entre 0 y 9
	{
    	alert("La direccion de telefono no es valida");
    	return false;
	}

	//Compruebo contraseña
	var contrasenia = document.forms["modificacion"]["contrasenia"].value;
	if( contrasenia.length!=0 &&( contrasenia.length < 8 || contrasenia.length > 10 || /^\s+$/.test(contrasenia))) { //Compruebo lo anterior y que tenga una longitud minima
		alert("La contraseña no está rellenado correctamente");
		return false;
	}

	//Compruebo la repeticion de contraseña
	var contrasenia2 = document.forms["modificacion"]["contrasenia2"].value;
	if(contrasenia2!=contrasenia) { //Compruebo que la segunda contraseña sea igual que la primera contraseña
		alert("La segunda contraseña no coincide con la primera");
		return false;
	}
		
	alert("Sus datos han sido actualizados");				 
	return true;
}