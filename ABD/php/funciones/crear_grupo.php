<?php

	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");

	crear_grupo();

	function crear_grupo(){
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

			$resultado = consulta($sql);

			
			// Buscamos el id el grupo.
			$id_grupo = numGrupos();

			// Buscamos a los usuarios que esten entre el rango de edad y le guste el tipo de musica
			$usuarios = buscar_usuarios_edad($edad_min, $edad_max, $tipo_musica);
			$n = $usuarios->num_rows;
			echo $n;
			if ($n > 0){
				while($fila = $usuarios->fetch_object()){
					$id_usuario = $fila->id_usuario;
					echo $id_usuario;
					
					insertar_usuario_grupo($id_usuario, $id_grupo);
				}
			}
			else {
				echo "no ha entrado en el if";
			}

			header("Location: ../../entrada.php");
		}
	}

	
	// Buscamos usuario que esten entre edad min y edad max y que les guste X tipo de musica
	function buscar_usuarios_edad($edad_min, $edad_max, $tipo_musica){
			
		$sql = "SELECT id_usuario FROM usuarios WHERE edad BETWEEN '$edad_min' AND '$edad_max' AND tipo_musica='$tipo_musica'";
	
		$resultado = consulta($sql);

		return $resultado;

	}

	function buscar_grupo($nombre){
		
		$sql = "SELECT id_grupo FROM grupos WHERE nombre_grupo = '$nombre'";	
		
		$resultado = consulta($sql);

		return $resultado;

	}

	function insertar_usuario_grupo($id_usuario, $id_grupo){
		
		$sql = "INSERT INTO grupo_usuario(id_usuario, id_grupo) VALUES ('$id_usuario', '$id_grupo')";	
		
		$resultado = consulta($sql);

	}

	function numGrupos(){

		$sql = "SELECT * FROM grupos";	
		
		$resultado = consulta($sql);

		$n = $resultado->num_rows; 

		return $n;

	}

?>