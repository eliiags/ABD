<?php

	include("conexion/conexion.php");

	// Conectamos la base de datos
	conecta_servidor('localhost', 'root');
	conecta_BD('music_abd');


	// Datos del usuario.
	$user = $_POST['user'];
	$pass = $_POST['password'];


	// COMPROBAR ESTOS DATOS CON LA BBDD
	$comprobar = mysql_query("SELECT * FROM usuarios WHERE email='$user' AND pass='$pass'");


	// Comprobamos que la contraseña cumpla los requisitos
	//if(strlen($pass) > 5){
	// Si la consulta ha devuelto una sola fila
	if(mysql_num_rows($comprobar) == 1){
		echo "Bien";

		// Creamos la sesion del usario
		session_start();
		
		$fila = mysql_fetch_object($comprobar);
		
		$_SESSION['usuario'] = $fila->id_usuario;
		$_SESSION['nombre_usuario'] = $fila->nombre;
		$_SESSION['tipo'] = $fila->tipo;
		// print_r($_SESSION['usuario']);
		// echo session_status();
		// echo session_id();	

		header("Location: inicio.php");
		exit();

		/*while($resultado = mysql_fetch_array($comprobar)){
			echo $resultado['nombre']."<br>";
		}*/
	}
	else{
		header("Location:index.php?error=1"); //Si el usuario o pass no coinciden con la BBDD
	}
	//}
	//else{
	//	header("Location:index.php?error=2"); //El pass no cumple los requisitos establecidos con la BBDD.
	//}

?>