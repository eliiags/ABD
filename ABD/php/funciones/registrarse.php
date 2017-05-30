<?php
	
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/filtrado_entrada.php");

	registro();

	function registro(){

		// COMPROBACIONES DE SEGURIDAD
		array_walk($_REQUEST, 'limpiarCadena');	

		// Definimos las variables con los datos del usuario
		$nombre       = htmlspecialchars(trim(strip_tags($_REQUEST["nombre"])));
		$apellidos    = htmlspecialchars(trim(strip_tags($_REQUEST["apellidos"])));
		$edad         = htmlspecialchars(trim(strip_tags($_REQUEST["edad"])));
		$tipo_musica  = htmlspecialchars(trim(strip_tags($_REQUEST["tipo_musica"])));
		$email        = htmlspecialchars(trim(strip_tags($_REQUEST["email"])));
		$pass     	  = htmlspecialchars(trim(strip_tags($_REQUEST["pass"])));
		$confirm_pass = htmlspecialchars(trim(strip_tags($_REQUEST["confirm_pass"])));

		// HASH
		$hashed = password_hash($pass, PASSWORD_DEFAULT);

		if(empty($nombre) || empty($apellidos) || empty($edad) || empty($tipo_musica) || empty($email) || empty($pass) || empty($confirm_pass) ||
	   	   !preg_match('/^[^@\s]+@([a-z0-9]+\.)+[a-z]{2,}$/i', $email) ||
	   	   !is_numeric($edad) ||
	   	   strlen($pass) < 8 ||
	   	   $pass != $confirm_pass) {
			echo "<p> Se ha producido un error al enviar los datos del formulario.</p>";
			echo "<a href='../../registro.php'><button class='btn btn-default dropdown-toggle engordar redondear' type='button' id='button'>Volver al formulario de registro</button></a>";
		}
		else{

			// Comprobar si el usuario ya está registrado en la BD.
			$res = comprobar_usuario($email);	

			if(mysqli_num_rows($res) > 1) {
				echo "<p> El nombre de usuario ya existe. Prueba con otro.</p>";
				echo "<a href='../../registro.php'><button class='btn btn-default dropdown-toggle engordar redondear' type='button' id='button'>Volver al formulario de registro</button></a>";
			}
			else{

				// Insertamos el usuario en la BD
				insertar_usuario($nombre, $apellidos, $email, $hashed, $edad, $tipo_musica);

				// Iniciar sesion 
				session_start();
				$sql = comprobar_usuario($email);

				$fila = $sql->fetch_object();
				
				$_SESSION['usuario'] = $fila->id_usuario;
				$_SESSION['nombre']  = $fila->nombre;
				$_SESSION['tipo']    = $fila->tipo;

				// Comprobamos si hay algun grupo en el que se pueda meter a un usuario
				$grupos = buscar_grupos($tipo_musica, $edad);
				$n = $grupos->num_rows;
				echo $n;
				if ($n > 0){
					while($fila = $grupos->fetch_object()){
						$id_grupo = $fila->id_grupo;
						echo $id_grupo;
						
						insertar_usuario_grupo($_SESSION['usuario'], $id_grupo);
					}
				}
				else {
					echo "no ha entrado en el if";
				}



				header("Location: ../../entrada.php");	
				exit();

			}

		}

	}

	function comprobar_usuario($email){

		$sql = "SELECT * FROM usuarios WHERE email='$email'";

		$resultado = consulta($sql);

		return $resultado;

	}	

	function insertar_usuario($nombre, $apellidos, $email, $pass, $edad, $tipo_musica){

		$sql = "INSERT INTO usuarios(nombre,apellidos,email,pass,edad,tipo_musica) VALUES ('$nombre', '$apellidos', '$email', '$pass', '$edad', '$tipo_musica')";

		$resultado = consulta($sql);

		return $resultado;

	}

	// Buscamos los grupos en los que el usuario pueda estar
	function buscar_grupos($tipo_musica, $edad){

		$sql = "SELECT id_grupo FROM grupos WHERE tipo_musica='$tipo_musica' AND edad_min<='$edad' AND edad_max>='$edad'";

		$resultado = consulta($sql);

		return $resultado;

	}

	function insertar_usuario_grupo($id_usuario, $id_grupo){
		
		$sql = "INSERT INTO grupo_usuario(id_usuario, id_grupo) VALUES ('$id_usuario', '$id_grupo')";	
		
		$resultado = consulta($sql);

	}

?>

