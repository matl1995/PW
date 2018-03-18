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
		<title>Publicación</title>
		<link rel="stylesheet" href="css/estilo-publicacion.css">
		<link rel="stylesheet" href="css/estilo-elementos-comunes.css">
		<link rel="stylesheet" href="css/estilo-pie-pagina.css">
		<link rel="icon" href="imagenes/logo.png">
		<script src="javascript/comentario.js"></script>
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
		<section id="seccion-publicacion">
			<section id="seccion-publicacion-publicacion">
				<?php
					$usuario=$_GET['usuario'];
					$numero=$_GET['publicacion'];
					$resultado = $conn->query("SELECT `name`,`pic-user`,`time`,`title`,`content`,`pic` FROM `publicaciones` WHERE `user`='$usuario' AND `numero`=$numero");
					while($row = $resultado->fetch_assoc()) {
						$imagen=$row["pic"];
						$nombre=$row["name"];
						$fotoUsuario=$row["pic-user"];
						$tiempo=$row["time"];
						$titulo=$row["title"];
						$contenido=$row["content"];
						echo "<p id='link-usuario-publicacion-in'>".$nombre."</a>";
						echo "<img id='imagen-usuario-publicacion-in' src='".$fotoUsuario."' width='50' height='50'/>";
						echo "<p id='parrafo-tiempo-publicacion-p-in'>".$tiempo."</p>";
						echo "<p id='link-titulo-publicacion-in'>".$titulo."</p>";
						echo "<p id='parrafo-contenido-publicacion-p-in'>".$contenido."</p>";
						echo "<img id='imagen-publicacion-in' src='".$imagen."' width='200' height='120'/>";
					}
				?>
			</section>
			<section id="seccion-publicacion-comentarios">
				<ul>
					<?php
						$usuario=$_GET['usuario'];
						$numero=$_GET['publicacion'];
						$resultado = $conn->query("SELECT `name`,`pic-user`,`time`,`content` FROM `comentarios` WHERE `user`='$usuario' AND `num-pub`=$numero");
						while($row = $resultado->fetch_assoc()) {
							$nombre=$row["name"];
							$fotoUsuario=$row["pic-user"];
							$tiempo=$row["time"];
							$contenido=$row["content"];
							echo "<li>";
								echo "<p id='link-usuario-comentario'>".$nombre."</a>";
								echo "<img src='".$fotoUsuario."' width='50' height='50'/>";
								echo "<p id='tiempo-comentario'>".$tiempo."</p>";
								echo "<p id='parrafo-comentario'>".$contenido."</p>";
							echo "</li>";
						}
					?>
				</ul>
			</section>
			<section id="seccion-publicacion-escribir">
				<?php
					$usuario=$_SESSION["usuario"];
					$resultado = $conn->query("SELECT `pic`,`name` FROM `usuarios` WHERE `user`='$usuario'");
					while($row = $resultado->fetch_assoc()) {
						$imagen=$row["pic"];
						$nombre=$row["name"];
					}
					echo "<a href='actual.php' id='link-usuario-escribir'><p>".$nombre."</p></a>";
					echo "<a href='actual.php'><img src='".$imagen."' width='50' height='50'/></a>";
				?>
				<?php
					$usuario=$_GET['usuario'];
					$numero=$_GET['publicacion'];
					$resultado = $conn->query("SELECT `name`,`pic` FROM `usuarios` WHERE `user`='$usuario' ");
					while($row = $resultado->fetch_assoc()) {
						$nombre=$row["name"];
						$fotoUsuario=$row["pic"];
						$tiempo=date('Y/m/d H:i:s');
						echo "<form name='ecomentario' action='php/escribir_comentario.php?usuario=".$usuario."&numpub=".$numero."&nombre=".$nombre."&foto=".$fotoUsuario."&tiempo=".$tiempo."' method='post' onsubmit='return validacion()'>";
					}
				?>
					<p id="texto-escribir-comentario">Escriba su comentario:</p>
					<textarea maxlength="50" name="comentario" required></textarea>
					<input type="submit" value="Enviar">
				</form>
			</section>
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