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
				<a class="navbar-brand">myMusic</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<form class="navbar-form navbar-right">
					<button type="submit" class="btn btn-default" title="Salir"><span class="glyphicon glyphicon-off"></span></button>
				</form>
				<form class="navbar-form navbar-right">
					<button type="submit" class="btn btn-default" title="Mis grupos"><span class="glyphicon glyphicon-music"></span></button>
				</form>
				<form class="navbar-form navbar-right">
					<button type="submit" class="btn btn-default" title="Mi Perfil"><span class="glyphicon glyphicon-user"></span></button>
				</form>
			</div>
		</div>
	</nav>

	<!--panel grande-->
	<div class="container-fluid">
		<div class="row">

			<!--sidebar-->
			<div class="col-sm-3 col-md-2 sidebar">
				<ul class="nav nav-sidebar">
					<li id="entrada"><a href="inicio.php">Bandeja de entrada <span class="badge badge-info">4</span></a></li>
					<li id="enviados" class="active"><a href=#>Enviados</a></li>
					<li id="grupos"><a href="mensajesGrupos.php">Mensajes de grupos</a></li>
				</ul>
				<div class="nuevo_mensaje">
					<button type="submit" class="btn btn-info" id="nuevo"><span class="glyphicon glyphicon-envelope"></span> Nuevo mensaje</button>
				</div>


					<!--NUEVO MENSAJE-->
					<div id="id01" class="modal">
						<form id="formulario" class="modal-content animate" method="post" action="inicio.php">
							<div class="container">
								<div class="row en">
										<p class="h3 text-left">Nuevo mensaje</p>
									<span type="submit" id="cerrar" class="close" title="Close Modal">&times;</span>
								</div>
								<div class="row en">
									<div class="form-group">
										<label for="contactos">Para:</label>
										<select class="form-control" id="contactos">
											<optgroup label="Todos">
												<option value="todos">Todos</option>
											</optgroup>
											<optgroup label="Contactos">
												<option value="contacto1">Pepe</option>
												<option value="contacto2">Manolo</option>
											</optgroup>
										</select>
									</div>
								</div>
								<div class="row en">
									<div class="form-group">
									  <label for="comment">Texto:</label>
									  <textarea class="form-control" name="cuerpo" rows="10" cols="30" placeholder="Escribir texto..." id="cuerpo"></textarea>
									</div>
								</div>
								<div class="row en">
									<div class="text-right">
										<input class="btn btn-info" type="submit" id="boton_enviar" value="Enviar"/>
									</div>
								</div>
							</div>	
							<br>	
						</form>
					</div><!--NUEVO MENSAJE-->



			</div> <!--sidebar-->

			<!--panel ppal-->
			<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
				<p class="h1 page-header">Enviados</p>

				<div class="panel_mensajes">
					
					<?php
						session_start();

						if (isset($_SESSION['usuario'])){
    						$usuario_actual = $_SESSION['usuario'];
						   								
							// Conectamos con la BD
							$link = mysql_connect('localhost', 'root', '')
							or die('No se pudo conectar: ' . mysql_error());

							mysql_select_db('music_abd') or die('No se pudo seleccionar la base de datos');     						
							$comprobar = mysql_query("SELECT * FROM usuarios JOIN mensajes ON id_dest = id_usuario  WHERE id_rem = (SELECT id_usuario FROM usuarios WHERE nombre_usuario='$usuario_actual' OR email='$usuario_actual') AND id_dest <> (SELECT id_usuario FROM usuarios WHERE nombre_usuario='$usuario_actual' OR email='$usuario_actual')");
					
							$nFilas = mysql_num_rows($comprobar);

							if($nFilas > 0){
								while($fila = mysql_fetch_object($comprobar)){
									$nombre    = $fila->nombre;
									$apellidos = $fila->apellidos;
									$asunto    = $fila->asunto;
									$cuerpo    = $fila->cuerpo;
									$fecha     = $fila->fecha;

										echo "<div class='panel panel-info'>
											<div class='cabecera panel-heading'>
												<span class='panel-title pull-left'>Para: $nombre $apellidos</span>
												<span class='panel-title pull-right'>$fecha</span>
												<div class='clearfix'></div>
											</div>
											<div class='panel-body'>
												<p>Asunto: $asunto</p><br>

												<p> $cuerpo	</p>
												<br>
												<div class='pull-right'>
													<button type='button' class='btn btn-info'>Responder</button>
													<button type='button' class='btn btn-info' title='Eliminar mensaje'><span class='glyphicon glyphicon-trash'></span></button>
												</div>
											</div>
										</div>";
								}	
							}
						}
					?>
				</div>

			</div><!--panel ppal-->
		</div> <!--row-->
	</div> <!--container-fluid-->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script><!--Scripts-->
	<script type="text/javascript" src="js/enviados.js"></script>
	<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
	
	
	

</body>
</html>
