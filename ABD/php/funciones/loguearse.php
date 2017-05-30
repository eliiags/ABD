<?php

	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/filtrado_entrada.php");

	login();

	function login(){

		// COMPROBACIONES DE SEGURIDAD
		array_walk($_REQUEST, 'limpiarCadena');	

		$user = htmlspecialchars(trim(strip_tags($_REQUEST["user"])));
		$password = $_POST['password'];
		
		// Comprobamos los datos en la BD
		$res = comprobar_usuario($user);

		// Comprobamos que la contraseña cumpla los requisitos
		// if(strlen($pass) > 5){
		// Si la consulta ha devuelto una sola fila
		if(mysqli_num_rows($res) == 1){

			// Comprobamos la contraseña
			$pass = comprobar_pass($user);
			$hash = $pass->fetch_object();

			if (password_verify("$password", "$hash->pass")) {

				// Creamos la sesion del usario
				session_start();
				
				$fila = mysqli_fetch_object($res);
				
				$_SESSION['usuario'] = $fila->id_usuario;
				$_SESSION['nombre']  = $fila->nombre;
				$_SESSION['tipo']    = $fila->tipo;

				header("Location: ../../entrada.php");
				exit();

				/*while($resultado = mysql_fetch_array($comprobar)){
					echo $resultado['nombre']."<br>";
				}*/
			}
		}
		else{
			header("Location: ../../index.php?error=1"); //Si el usuario o pass no coinciden con la BBDD
		}
		
	}

	
	function comprobar_usuario($user){
		
		$sql = "SELECT * FROM usuarios WHERE email='$user'";

		$resultado = consulta($sql);

		return $resultado;
	}

	function comprobar_pass($email){
		
		$sql = "SELECT pass FROM usuarios WHERE email='$email'";

		$resultado = consulta($sql);

		return $resultado;
	}

?>