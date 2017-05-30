<?php
	
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");

	borrar();

	// borrar mensajes
	function borrar(){
		//** Enviar mensajes **//
		if(isset($_POST['mensaje'])){

			// id mensaje
			$mensaje = $_POST['mensaje'];
			$tipo    = $_POST[tipo];

			// Consulta sql
			$sql = "DELETE FROM mensajes WHERE id='$mensaje'";		

			$resultado = consulta($sql);

			if ($tipo == "recibidos"){
				header("Location: ../../entrada.php");
			}
			else{
				header("Location: ../../enviados.php");
			}
		}
	}

	/***BANDEJA DE ENTRADA****/
	function buscar_mensajes_recibidos($usuario_actual){
		
		$sql = "SELECT * FROM usuarios JOIN mensajes ON id_rem = id_usuario WHERE id_rem<>'$usuario_actual' AND id_dest='$usuario_actual' ORDER BY fecha DESC";

		$resultado = consulta($sql);

		return $resultado;

	}


	function buscar_todos($usuario_actual, $tipo){

		switch ($tipo) {
			case 'recibidos':
				$sql = "SELECT * FROM usuarios JOIN mensajes_todos ON id_usuario=remitente WHERE remitente<>'$usuario_actual' AND id_grupo IS NULL ORDER BY fecha DESC";

				$resultado = consulta($sql);

				return $resultado;
				break;
			case 'enviados':
				$sql = "SELECT * FROM usuarios JOIN mensajes_todos ON id_usuario=remitente WHERE remitente='$usuario_actual' AND id_grupo IS NULL ORDER BY fecha DESC";
				$resultado = consulta($sql);

				return $resultado;
				break;
			
			default:
				# code...
				break;
		}
	}


	/****ENVIADOS****/
	function buscar_mensajes_enviados($usuario_actual){
		
		$sql = "SELECT * FROM usuarios JOIN mensajes ON id_dest = id_usuario WHERE id_rem='$usuario_actual' AND id_dest<>'$usuario_actual' ORDER BY fecha DESC";

		$resultado = consulta($sql);

		return $resultado;

	}

?>