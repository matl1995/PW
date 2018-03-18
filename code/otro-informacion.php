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
			$usuario=$_GET['usuario'];
			$resultado = $conn->query("SELECT `name` FROM `usuarios` WHERE `user`='$usuario'");
			while($row = $resultado->fetch_assoc()) {
				$nombre=$row["name"];
			}
			echo "<title>".$nombre."</title>";
		?>
		<link rel="stylesheet" href="css/estilo-otro-usuario.css">
		<link rel="stylesheet" href="css/estilo-elementos-comunes.css">
		<link rel="stylesheet" href="css/estilo-pie-pagina.css">
		<link rel="icon" href="imagenes/logo.png">
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
				<?php
					$usuario=$_GET['usuario'];
					echo "<button><a href='otro-usuario.php?usuario=".$usuario."'>Biografía</a></button>";
					echo "<button><a href='otro-fotos.php?usuario=".$usuario."'>Fotos</a></button>";
					echo "<button><a href='otro-informacion.php?usuario=".$usuario."'>Información</a></button>";
				?>

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

		<!--Seccion con la informacion del usuario-->
		<section id="seccion-publicaciones">
			<h3 id="seccion-publicaciones-h3">Información</h3>
			<?php
				$usuario=$_GET['usuario'];
				$resultado = $conn->query("SELECT `name`,`lastname`,`user`,`pic` FROM `usuarios` WHERE `user`='$usuario' ");
				while($row = $resultado->fetch_assoc()) {
					$user=$row["user"];
					$apellidos=$row["lastname"];
					$nombre=$row["name"];
					$imagen=$row["pic"];
					echo "<img id='informacion-foto-perfil' src='".$imagen."' height='150' width='150' />";
					echo "<p id='seccion-publicaciones-p'>";
						echo "<b>Nombre:</b> ".$nombre."<br>";
						echo "<b>Apellidos:</b> ".$apellidos."<br>";
						echo "<b>Nombre de usuario:</b> ".$user."<br>";
					echo "</p>";
				}
			?>
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