function validacion() {
	//Compruebo titulo
	var titulo = document.forms["escribir_publicacion"]["titulo"].value;
	if( titulo == null || titulo.length == 0 || titulo.length > 10 || /^\s+$/.test(titulo) ) { //Compruebo que no este vacio, que no supere la longitud maxima, que no este lleno de espacios en blanco
		alert("El titulo no está rellenado correctamente");
		return false;
	}

	//Compruebo publicacion
	var publicacion = document.forms["escribir_publicacion"]["publicacion"].value;
	if( publicacion == null || publicacion.length == 0 || publicacion.length > 140 || /^\s+$/.test(publicacion) ) { //Compruebo que no este vacio, que no supere la longitud maxima, que no este lleno de espacios en blanco
		alert("La publicacion no está rellenado correctamente");
		return false;
	}

	alert("Su publicacion ha sido publicada");		 
	return true;
}