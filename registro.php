<!DOCTYPE html>
<html lang="es">
<head>
	<title>Registro</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/registro.css">
</head>
<body>
	<!--Contenedor, panel principal-->
	<div class="container-fluid">
		<form class="registro" id="formulario" method="POST" action="registrarse.php">
			<p class="h2 reg">Registrarse</p>
			<br>

			<!--Nombre-->
			<div class="form-group">
				<input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre" autofocus>
			</div>
			<!--Apellidos-->
			<div class="form-group">
				<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellidos">
			</div>
			<!--Edad-->
			<div class="form-group">
				<input type="text" class="form-control" id="edad" name="edad" placeholder="Edad">
			</div>
			<div class="form-group">
				<select class="form-control" name="tipo_musica">
					<option value="">Elige tu tipo de música preferida</option>
					<option value="Pop">Pop</option>
					<option value="Rock">Rock</option>
					<option value="Jazz">Jazz</option>
					<option value="Blues">Blues</option>
					<option value="Rap">Rap</option>
					<option value="Electrónica">Electrónica</option>
					<option value="Clásica">Clásica</option>
					<option value="Reggaeton">Reggaeton</option>
					<option value="Reggae">Reggae</option>
				</select>
			</div>	
			<!--email-->
			<div class="form-group">
				<input type="email" class="form-control" id="email" name="email" placeholder="e-mail">
			</div>			
			<!--Contraseña-->
			<div class="form-group">
				<input type="password" class="form-control" id="pass" name="pass" placeholder="Contraseña">
			</div>			
			<!--Repetir contraseña-->
			<div class="form-group">
				<input type="password" class="form-control" id="confirm_pass" name="confirm_pass" placeholder="Repetir contraseña">
			</div>
			<!--recordar contraseña-->
			<div class="checkbox-inline">
				<input type="checkbox">
				<p id="term">He leído y acepto los <a id="pincha" href="#">términos y condiciones legales</a> y también recibir comunicaciones electrónicas</p>	
			</div>
	
			<button class="btn btn-lg btn-info btn-block" type="submit" id="boton_registro" value="Registrarse">Registrarse</button>
		</form>
	</div> <!-- /container -->

	<!--<footer class="container-fluid text-center">
		<p id="pie">Creado por: Elianni</p>
	</footer>-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	<script type="text/javascript" src="js/registro.js"></script>

</body>
</html>
