<?php

	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");

	enviar_mensaje();

	function enviar_mensaje(){
		//** Enviar mensajes **//
		if(isset($_POST['contacto'])){

			if($_POST['contacto'] == 'todos'){
				// Asunto
				$asunto = $_POST['asunto'];

				// Cuerpo del mensaje
				$cuerpo = $_POST['cuerpo'];

				// Remitente
				$usuario_actual = $_POST['usuario_actual'];

				// Consulta sql
				$sql = "INSERT INTO mensajes_todos(remitente,asunto,cuerpo) VALUES ('$usuario_actual','$asunto','$cuerpo')";		

				$resultado = consulta($sql);

				print_r($resultado);
			}
			else{
				// Remitente
				$usuario_actual = $_POST['usuario_actual'];

				// Destinatario
				$dest = $_POST['contacto'];	

				// Asunto
				$asunto = $_POST['asunto'];

				// Cuerpo del mensaje
				$cuerpo = $_POST['cuerpo'];

				// Consulta sql
				$sql = "INSERT INTO mensajes(id_dest,id_rem,asunto,cuerpo) VALUES ('$dest','$usuario_actual','$asunto','$cuerpo')";		

				$resultado = consulta($sql);
			}
			header("Location: ../../entrada.php");
		}

	}


	function buscar_usuarios($usuario_actual){
		
		$sql = "SELECT nombre, apellidos, id_usuario FROM usuarios WHERE id_usuario <> '$usuario_actual'";

		$resultado = consulta($sql);

		return $resultado;
	}

?>