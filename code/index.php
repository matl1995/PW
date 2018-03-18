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
			<form name="registro" action="php/registro.php" method="post" onsubmit="return validacion()">
				Nombre:<br>
				<input type="text" name="nombre" required><br><br>
				Apellidos:<br>
				<input type="text" name="apellidos" required><br><br>
				Usuario:<br>
				<input type="text" name="usuario" required><br><br>
				Contraseña:<br>
				<input type="password" name="contrasenia" required><br><br>
				Repite contraseña:<br>
				<input type="password" name="contrasenia2" required><br><br>
				<input type="submit" value="Registro">
			</form>
		</section>

		<footer id="pie">
			<p>
				<a href="contacto.html">Contacto</a> - <a href="como_se_hizo.pdf">Como se hizo</a>
			</p>
		</footer>
	</body>

</html>