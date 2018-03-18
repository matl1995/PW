<?php 
	session_start();

	$servername = "localhost";
	$username = "pw_71358141";
	$password = "1995miguel";
	$dbname = "pw_71358141";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Conexión a base de datos fallida");
	}

	$conn->query("SET NAMES 'utf8'");
?>

<!DOCTYPE html>
<html lang="es">

	<head>
		<meta charset="utf-8">
		<?php
			$usuario=$_SESSION["usuario"];
			$resultado = $conn->query("SELECT `name` FROM `usuarios` WHERE `user`='$usuario'");
			while($row = $resultado->fetch_assoc()) {
				$nombre=$row["name"];
			}
			echo "<title>".$nombre."</title>";
		?>
		<link rel="stylesheet" href="css/estilo-elementos-comunes.css">
		<link rel="stylesheet" href="css/estilo-pie-pagina.css">
		<link rel="stylesheet" href="css/estilo-actual.css">
		<link rel="icon" href="imagenes/logo.png">
		<script src="javascript/publicacion.js"></script>
		<script src="javascript/ventana.js"></script>
	</head>

	<body>
		<header id="cabecera">
			<a href="portada.php"><img id="img-logo" src="imagenes/logo.png"/></a>
			<a href="portada.php"><h1>DEC</h1></a>
			<?php
				$usuario=$_SESSION["usuario"];
				$resultado = $conn->query("SELECT `pic`,`name` FROM `usuarios` WHERE `user`='$usuario'");
				while($row = $resultado->fetch_assoc()) {
					$imagen=$row["pic"];
					$nombre=$row["name"];
				}
				$resultado1 = $conn->query("SELECT `title` FROM `publicaciones` WHERE `user`='$usuario'");
				$titulos=array();
				while($row = $resultado1->fetch_assoc()) {
					array_push($titulos,$row["title"]);
				}
				$titulos_str = implode(",", $titulos);

				echo "<a onmouseover='abrirVentana(`".$titulos_str."`)' onmouseout='cerrarVentana()' onclick='cerrarVentana()' href='actual.php'><img id='img-user' src='".$imagen."'/></a>";
				echo "<a href='actual.php' id='nombre-usuario-cabecera'>".$nombre."</a>";
			?>
			<a href="php/cerrar_sesion.php" id="cerrar-sesion-cabecera">Cerrar sesión</a>
		</header>

		<!--Seccion superior con biografia-fotos-info-->
		<section id="seccion-superior">
				<button><a href="actual.php">Biografía</a></button>
				<button><a href="actual-fotos.php">Fotos</a></button>
				<button><a href="actual-informacion.php">Información</a></button>
		</section>

		<!--Seccion superior con los amigos que tiene el usuario en la red social-->
		<section id="seccion-amigos">
			<ul>
				<?php
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `pic`,`name`,`user` FROM `usuarios` WHERE `user`<>'$usuario'");
					while($row = $resultado->fetch_assoc()) {
						$imagen=$row["pic"];
						$nombre=$row["name"];
						$user=$row["user"];

						$resultado1 = $conn->query("SELECT `title` FROM `publicaciones` WHERE `user`='$user'");
						$titulos=array();
						while($fila = $resultado1->fetch_assoc()) {
							array_push($titulos,$fila["title"]);
						}
						$titulos_str = implode(",", $titulos);

						echo "<li>";
							echo"<a onmouseover='abrirVentana(`".$titulos_str."`)' onmouseout='cerrarVentana()' onclick='cerrarVentana()' href='otro-usuario.php?usuario=".$user."'>";
								echo "<p>".$nombre."</p>";
								echo "<img src='".$imagen."' height='75' width='75' />";
							echo "</a>";
						echo "</li>";
					}
				?>
			</ul>
		</section>

		<!--Seccion con las publicaciones de los usuarios-->
		<section id="seccion-publicaciones-usuario">
			<!--Seccion para escribir una nueva publicacion-->
			<section id="personal-publicar">
				<!--Datos del usuario que esta logeado-->
				<?php
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `pic`,`name` FROM `usuarios` WHERE `user`='$usuario'");
					while($row = $resultado->fetch_assoc()) {
						$imagen=$row["pic"];
						$nombre=$row["name"];
					}
					echo "<a href='actual.php' id='link-usuario-escribir'>".$nombre."</a>";
					echo "<a href='actual.php'><img src='".$imagen."' width='75' height='75'/></a>";
				?>
				<!--Cabecera del formulario-->
				<?php
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `name`,`pic`,`user` FROM `usuarios` WHERE `user`='$usuario' ");
					while($row = $resultado->fetch_assoc()) {
						$user=$row["user"];
						$nombre=$row["name"];
						$fotoUsuario=$row["pic"];
						$tiempo=date('Y/m/d H:i:s');
						echo "<form name='escribir_publicacion' action='php/escribir_publicacion.php?usuario=".$user."&nombre=".$nombre."&foto=".$fotoUsuario."&tiempo=".$tiempo."' method='post' onsubmit='return validacion()' >";
					}
				?>
					<p id="parrafo-escribir-titulo">Escriba el titulo de la publicación:</p>
					<textarea id="input-titulo-pub" maxlength="30" name="titulo" required></textarea>
					<p id="parrafo-escribir-publicacion">Escriba la publicación:</p>
					<textarea id="input-contenido-pub" maxlength="140" name="publicacion" required></textarea>
					<input type="submit" value="Enviar">
					<input id="selector-imagen" type="file" name="myimage">
				</form>
			</section>
			<ul>
				<?php
					$contador=0; //Hacer que genere las paginas numeradas dinamicamente
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `user`,`time`,`numero`,`pic` FROM `publicaciones` WHERE `user`='$usuario' AND `pic`IS NOT NULL ORDER BY `time` DESC");
					while($row = $resultado->fetch_assoc()) {
						$user=$row["user"];
						$tiempo=$row["time"];
						$numero=$row["numero"];
						$imagen=$row["pic"];
						echo "<li>";
							echo "<section id='seccion-publicaciones-section-fotos'>";
								echo "<a href='publicacion.php?publicacion=".$numero."&usuario=".$user."'><img id='imagen-publicacion-in' src='".$imagen."' width='240' height='120'/></a>";
							echo "</section>";
						echo "</li>";
					}
				?>
			</ul>
		</section>

		<!--Seccion con los usuarios activos-->
		<aside id="seccion-amigos-activos">
			<ul>
				<li>
					<h6>Usuarios Activos</h6>
				</li>
				<?php
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `pic`,`name`,`user` FROM `usuarios` WHERE `user`<>'$usuario' AND `activo`=1");
					while($row = $resultado->fetch_assoc()) {
						$imagen=$row["pic"];
						$nombre=$row["name"];
						$user=$row["user"];

						$resultado1 = $conn->query("SELECT `title` FROM `publicaciones` WHERE `user`='$user'");
						$titulos=array();
						while($fila = $resultado1->fetch_assoc()) {
							array_push($titulos,$fila["title"]);
						}
						$titulos_str = implode(",", $titulos);

						echo "<li>";
							echo"<a href='otro-usuario.php?usuario=".$user."'>";
								echo "<p>".$nombre."</p>";
								echo "<img onmouseover='abrirVentana(`".$titulos_str."`)' onmouseout='cerrarVentana()' onclick='cerrarVentana()' src='".$imagen."' height='75' width='75' />";
							echo "</a>";
						echo "</li>";
					}
				?>
			</ul>
		</aside>

		<footer id="pie">
			<p>
				<a href="contacto.php">Contacto</a> - <a href="como_se_hizo.pdf">Como se hizo</a>
			</p>
		</footer>
	</body>

</html>

<?php
	$conn->close(); 
?>