<?php



	
	include("conexion/conexion.php");

	// Conectamos la base de datos
	conecta_servidor('localhost', 'root');
	conecta_BD('music_abd');
	

	// Definimos las variables con los datos del usuario
	$nombre = $_POST['nombre'];
	$apellidos = $_POST['apellidos'];
	$edad = $_POST['edad'];
	$tipo_musica = $_POST['tipo_musica'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];


	// COMPROBAR QUE EL NOMBRE DE USUARIO Y EL EMAIL NO EXISTEN YA EN LA BASE DE DATOS
	$comprobar = mysql_query("SELECT * FROM usuarios WHERE email='$email'");

	if(mysql_num_rows($comprobar) > 1){
		// Ya existe el usuario
	}
	else{
		// Insertamos los valores en la tabla
		mysql_query("INSERT INTO usuarios(nombre,apellidos,email,pass,edad,tipo_musica) VALUES ('$nombre', '$apellidos', '$email', '$pass', '$edad', '$tipo_musica')");

		// Iniciar sesion 
		session_start();
		$sql = mysql_query("SELECT * FROM usuarios WHERE email='$email'");

		$fila = mysql_fetch_object($sql);
		
		$_SESSION['usuario'] = $fila->id_usuario;
		$_SESSION['nombre_usuario'] = $fila->nombre;

		header("Location: inicio.php");	
		exit();
	}



	

?>

