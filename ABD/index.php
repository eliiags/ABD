<?php
	session_start();

	if(isset($_SESSION['usuario']))
	{
		session_destroy();
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>Iniciar Sesión</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/login.css">
</head>
<body>
	<!--Contenedor, panel principal-->
	<div class="container-fluid">
		<form class="inicio" id="formulario" method="POST" action="php/funciones/loguearse.php">
			<p class="h2 login">Iniciar Sesión</p>
			<br>

			<div class="form-group">
				<input type="email" class="form-control" id="user" name='user' placeholder="Escribe tu e-mail" autofocus>
			</div>
			<div class="form-group">
				<input type="password" class="form-control" id="password" name='password' placeholder="Contraseña">
			</div>

			<!--recordar contraseña-->
			<div class="checkbox">
				<label>
					<input type="checkbox" value="remember-me" id="remember" name="remember"> <span id="recordar">Recordar mi contraseña</span>
				</label>
			</div>

			<button class="btn btn-lg btn-info btn-block" type="submit" id="boton_iniciar" value="Iniciar Sesión">Iniciar Sesión</button>
			<br>
			<p id="registrarse">Si no estás registrado <a id="pincha" href="registro.php">pincha aquí</a>. <br> Anímate, es gratis!</p>
		</form>
	</div> <!-- /container -->

	<!--<?php
		if(isset($_GET['error'])){
			if($_GET['error'] == 1){
				echo "<p>No existe el usuario o el password es incorrecto</p>";
			}
			if($_GET['error'] == 2){
				echo "<p>El password no cumple los requisitos</p>";
			}
		}
	?>-->
	
	<footer class="container-fluid text-center">
		<p id="pie">Creado por: Elianni</p>
	</footer>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/login.js"></script>

</body>
</html>
