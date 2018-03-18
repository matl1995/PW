<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<title>Inicio</title>
		<link rel="stylesheet" href="css/estilo-index-contacto.css">
		<link rel="stylesheet" href="css/estilo-pie-pagina.css">
		<link rel="icon" href="imagenes/logo.png">
		<script src="javascript/index.js"></script>
	</head>

	<body>
		<header id="cabecera">
			<a href="portada.php"><h1>DEC</h1></a>
			<form name="inicio_sesion" action="php/inicio_sesion.php" method="post" onsubmit="return validacion1()">
				Usuario:<br>
				<input type="text" name="usuario" required><br>
				Contraseña:<br>
				<input type="password" name="contrasenia" required><br>
				<input type="submit" value="Acceder">
			</form>
		</header>

		<!--Sección izquierda-->
		<section id="seccion-izquierda-index">
			<img src="imagenes/logo.png"/>
		</section>

		<!--Seccion derecha-->
		<section id="seccion-derecha-index">
			<h3 id="h3-contacto">Información de contacto</h3>
			<p id="parrafo-contacto">
				<b>Dirección postal: </b> C/Paseillo Nº10 Granada Granada CP: 18014<br>
				<b>Numero de teléfono: </b> 958 224 555<br>
				<b>Correo electronico: </b> atencion-cliente@dec.com<br>
				<b>Autor del sitio web: </b> Miguel Ángel Torres López <br>
			</p>
		</section>

		<footer id="pie">
			<p>
				<a href="contacto.html">Contacto</a> - <a href="como_se_hizo.pdf">Como se hizo</a>
			</p>
		</footer>
	</body>

</html>