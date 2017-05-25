<?php
	include("conexion/conexion.php");

	// Iniciamos sesion con el usuario
	session_start();

	if(!isset($_SESSION['usuario']))
	{
		header("Location: index.php");	
		exit();
	}


	// Conectamos la base de datos
	conecta_servidor('localhost', 'root');
	conecta_BD('music_abd');


	$usuario_actual = $_SESSION['usuario'];
	$nombre_usuario = $_SESSION['nombre_usuario'];
	$admin 			= $_SESSION['tipo'];

	//** Enviar mensajes **//
	if(isset($_POST['contacto'])){

		if($_POST['contacto'] == 'todos'){
			// Asunto
			$asunto = $_POST['asunto'];

			// Cuerpo del mensaje
			$cuerpo = $_POST['cuerpo'];

			// Consulta sql
			$sql = "INSERT INTO mensajes_todos(remitente,asunto,cuerpo) VALUES ('$usuario_actual','$asunto','$cuerpo')";		

			$consulta = mysql_query($sql);
		}
		else{
			// Destinatario
			$dest = $_POST['contacto'];	

			// Asunto
			$asunto = $_POST['asunto'];

			// Cuerpo del mensaje
			$cuerpo = $_POST['cuerpo'];

			// Consulta sql
			$sql = "INSERT INTO mensajes(id_dest,id_rem,asunto,cuerpo) VALUES ('$dest','$usuario_actual','$asunto','$cuerpo')";		

			$consulta = mysql_query($sql);
		}
	}

	//** Enviar mensajes **//
	if(isset($_POST['mensaje'])){

		// id mensaje
		$mensaje = $_POST['mensaje'];
		echo $mensaje;

		// Consulta sql
		$sql = "DELETE FROM mensajes WHERE id='$mensaje'";		

		$consulta = mysql_query($sql);
	}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<title>myMusic</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/enviados.css">
</head>

<body>

	<nav class="navbar navbar-light navbar-fixed-top">
		<div class="container-fluid">
			<div class="navbar-header">
				<a class="navbar-brand">myMusic <span class="glyphicon glyphicon-music"></span></a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<form class="navbar-form navbar-right" action="index.php">
					<button type="submit" class="btn btn-default" title="Salir"><span class="glyphicon glyphicon-off"></span></button>
				</form>
				<form class="navbar-form navbar-right">
					<button type="submit" class="btn btn-default" title="Mi Perfil"><span class="glyphicon glyphicon-user"></span> Bienvenid@, <?php echo $nombre_usuario ?>!</button>
				</form>
			</div>
		</div>
	</nav>


	<!--panel grande-->
	<div class="container-fluid">
		<div class="row">
			<!--panel ppal-->
			<div class="col-sm-6 col-sm-offset-6 col-md-8 col-md-offset-2 main">
				<p class="h2 page-header">Mi Perfil</p>

				<div class="alert alert-info">
					<p class="h3">Elianni Aguero</p>
					<p><strong>e-mail: </strong>eli@ucm.es</p>
					<p><strong>Edad: </strong>21</p>
					<table>
						<th>
						  <tr>
						    <th>Mis grupos</th>
						  </tr>
						</th>
						  <tr>
						    <td>John</td>
						  </tr>
						  <tr>
						    <td>Mary</td>
						  </tr>
						  <tr>
						    <td>July</td>
						  </tr>
					</table>


					
				



				</div>


				<div class="panel_mensajes">
					
					<?php
						if (isset($_SESSION['usuario'])){
					   						
							$comprobar = mysql_query("SELECT * FROM usuarios JOIN mensajes ON id_rem = id_usuario WHERE id_rem<>'$usuario_actual' AND id_dest='$usuario_actual' ORDER BY fecha DESC");

							$nFilas = mysql_num_rows($comprobar);

							if($nFilas > 0){
								while($fila = mysql_fetch_object($comprobar)){
									$nombre    = $fila->nombre;
									$apellidos = $fila->apellidos;
									$asunto    = $fila->asunto;
									$cuerpo    = $fila->cuerpo;
									$fecha     = $fila->fecha;
									$mensaje   = $fila->id;

										echo "<div class='panel panel-info'>
												<div class='cabecera panel-heading'>
													<span class='panel-title pull-left'>De: $nombre $apellidos</span>
													<span class='panel-title pull-right'>$fecha</span>
													<div class='clearfix'></div>
												</div>
												<div class='panel-body'>
													<p>Asunto: $asunto</p><br>

													<p> $cuerpo	</p>
													<div class='pull-right'>
														<form id='eliminar_mensaje' name='eliminar_mensaje' method='POST' action='inicio.php'>
															<input type='hidden' class='form-control' id='mensaje' name='mensaje' value='$mensaje'/>
															<button type='submit' class='btn btn-info' title='Eliminar mensaje'><span class='glyphicon glyphicon-trash'></span></button>
														</form>
													</div>
												</div>
											</div>";
											echo $mensaje;
								}	
							}
							else{
								echo "<div class='alert alert-info'>
										<strong>Vaya!</strong> Por ahora no tienes mensajes.
									</div>";
							}
						}
					?>
				</div>
				<br>

				

					<?php
						if (isset($_SESSION['usuario'])){

							$consulta = mysql_query("SELECT * FROM usuarios JOIN mensajes_todos ON id_usuario=remitente WHERE remitente<>'$usuario_actual' ORDER BY fecha DESC");

							$n = mysql_num_rows($consulta);

							echo "<p class='h3 page-header'>Mensajes enviados para todos los contactos</p>
								<div class='panel_mensajes'>";
								if($n > 0){
									while($nfila = mysql_fetch_object($consulta)){
										$nombre    = $nfila->nombre;
										$apellidos = $nfila->apellidos;
										$asunto    = $nfila->asunto;
										$cuerpo    = $nfila->cuerpo;
										$fecha     = $nfila->fecha;

										echo "<div class='panel panel-danger'>
												<div class='cabecera panel-heading'>
													<span class='panel-title pull-left'>De: $nombre $apellidos</span>
													<span class='panel-title pull-right'>$fecha</span>
													<div class='clearfix'></div>
												</div>
												<div class='panel-body'>
													<p>Asunto: $asunto</p><br>
													<p> $cuerpo	</p>
												</div>
											</div>";
									}	
								}
							echo "</div>";
						}
					?>
				

			</div><!--panel ppal-->
		</div> <!--row-->
	</div> <!--container-fluid-->



	



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!--Scripts-->
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	
</body>
</html>
