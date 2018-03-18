function validacion() {
	//Compruebo comentario
	var comentario = document.forms["ecomentario"]["comentario"].value;
	if( comentario == null || comentario.length == 0 || comentario.length > 50 || /^\s+$/.test(comentario) ) { //Compruebo que no este vacio, que no supere la longitud maxima, que no este lleno de espacios en blanco
		alert("El comentario no está rellenado correctamente");
		return false;
	}

	alert("Su comentario ha sido enviado"); 
	return true;
}