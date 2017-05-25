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


	//** Crear un grupo **//
	if(isset($_POST['nombre_grupo'])){

		// NOmbre de grupo
		$nombre_grupo = $_POST['nombre_grupo'];

		// Tipo de musica
		$tipo_musica = $_POST['tipo_musica'];
		
		// edad min
		$edad_min = $_POST['edad_min'];
		
		// edad max
		$edad_max = $_POST['edad_max'];

		// Consulta sql
		$sql = "INSERT INTO grupos(nombre_grupo,tipo_musica,edad_min,edad_max) VALUES ('$nombre_grupo','$tipo_musica','$edad_min','$edad_max')";		

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
				<?php
					if($admin){
						echo "<form class='navbar-form navbar-right'>
								<button type='button' class='btn btn-default' title='Mis grupos'  data-toggle='modal' data-target='#myModalGrupos'><span class='glyphicon glyphicon-music'></span></button>
							</form>";
					}
				?>
				<form class="navbar-form navbar-right">
					<button type="submit" class="btn btn-default" title="Mi Perfil"><span class="glyphicon glyphicon-user"></span> Bienvenid@, <?php echo $nombre_usuario ?>!</button>
				</form>
			</div>
		</div>
	</nav>

				<!-- CREAR GRUPO -->
				<div class="modal fade" id="myModalGrupos" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content modal_grupo">
							<form id="nuevo_grupo" method="post" action="inicio.php">
								<div class="modal-header">
									<button type="button" id="cerrar" class="close" data-dismiss="modal">&times;</button>
									<p class="h4 modal-title">Crear grupo</p>
								</div>
								<div class="modal-body">
									<!--Nombre del grupo-->
									<div class="form-group">
										<label for="nombre_grupo">Nombre del grupo</label>
										<input type="text" class="form-control" id="nombre_grupo" name="nombre_grupo" autofocus>
									</div>
									<!--Tipo de musica-->
									<div class="form-group">
										<label for="tipo_musica">Elige tipo de música</label>
										<select class="form-control" id="tipo_musica" name="tipo_musica">
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
									<!--Edad-->
									<div class="container">
										<div class="form-group form-inline">
											<div class="col-sm-2">
												<label for="edad_min">Edad mínima</label>
												<input type="text" class="form-control" id="edad_min" name="edad_min">
											</div>
											<div class="col-sm-1">
											</div>
											<div class="col-sm-2">
												<label for="edad_max">Edad máxima</label>
												<input type="text" class="form-control" id="edad_max" name="edad_max">
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-info">Crear</button>
								</div>
							</form>
						</div>

					</div>
				</div>



	<!--panel grande-->
	<div class="container-fluid">
		<div class="row">

			<!--sidebar-->
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li id="entrada" class="active"><a href="#">Bandeja de entrada</a></li>
					<li id="enviados"><a href="enviados.php">Enviados</a></li>
					<li id="grupos"><a href="mensajesGrupos.php">Mensajes de grupos</a></li>
				</ul>
				
				<div class=" nuevo_mensaje">
					<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-envelope"></span> Nuevo mensaje</button>
				</div>
			</div> <!--sidebar-->



					<!--NUEVO MENSAJE-->
					<div class="modal fade" id="myModal">
						<div class="modal-dialog">

							<!-- Modal content-->
							<div class="modal-content">
								<form id="nuevoMensaje" method="post" action="inicio.php">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">&times;</button>
										<p class=" h3 modal-title">Nuevo mensaje</p>
									</div>
									<div class="modal-body">
										<div class="form-group">
											<label for="contactos">Para:</label>
											<select class="form-control" id="contacto" name="contacto">
												<?php
													$consulta_usuarios = mysql_query("SELECT nombre, apellidos, id_usuario FROM usuarios WHERE id_usuario <> '$usuario_actual'");

													$n_usuarios = mysql_num_rows($consulta_usuarios);

													if($n_usuarios > 0){
														echo "<option>Contactos</option>
															<optgroup label='Todos'>
																<option value='todos'>Todos los contactos</option>
															</optgroup>
															<optgroup label='Contactos'>";
																while($fila_usuario = mysql_fetch_object($consulta_usuarios)){
																	$usuario   = $fila_usuario->id_usuario;
																	$nombre    = $fila_usuario->nombre;
																	$apellidos = $fila_usuario->apellidos;
																	echo "<option value='$usuario'>$nombre $apellidos</option>";
																}
														echo "</optgroup>";
													}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="asunto">Asunto:</label>
											<input type="text" class="form-control" id="asunto" name="asunto">
										</div>
										<div class="form-group">
											<label for="cuerpo">Texto:</label>
											<textarea class="form-control" name="cuerpo" rows="5" placeholder="Escribir texto..." id="cuerpo"></textarea>
										</div>
									</div>
									<div class="modal-footer">
										<input class="btn btn-info" type="submit" name="boton_enviar" id="boton_enviar" value="Enviar"/>
									</div>
								</form>
							</div>

						</div>
					</div>



			<!--panel ppal-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<p class="h2 page-header">Bandeja de entrada</p>

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
	<script type="text/javascript" src="js/nuevoGrupo.js"></script>

	
</body>
</html>
