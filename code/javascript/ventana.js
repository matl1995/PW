var ventana;

function abrirVentana(titulos) {
	ventana = window.open("", "ventana", "width=500,height=500,top=100,left=650"); //Creo una nueva ventana con las dimensiones deseadas
	ventana.document.write("<h1 style='color:#365FA7;'>Publicaciones:</h1>"); //Introduzco un titulo con las propiedades deseadas
	var titles = titulos.split(",").join("<br/>"); //Separo los titulos cuando encuentre comas y los vuelvo a unir añadiendo saltos de linea en medio
	ventana.document.write("<h3 style='color:#488D61;margin-left:1em;'>"+titles+"</h3>"); //Muestro los titulos de las publicaciones
}

function cerrarVentana() {
	ventana.close();
}