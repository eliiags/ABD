<?php
	
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/funciones/consulta.php");

	function buscar_mensajes_grupos($usuario_actual, $id_grupo){

		$sql = "SELECT * FROM mensajes_todos JOIN usuarios ON remitente=id_usuario WHERE id_grupo='$id_grupo' ORDER BY fecha DESC";

		$resultado = consulta($sql);

		return $resultado;
	}

	function buscar_grupos($usuario_actual){
		
		$sql = "SELECT * FROM grupo_usuario AS GU JOIN grupos AS G ON GU.id_grupo=G.id_grupo  WHERE GU.id_usuario='$usuario_actual'";

		$resultado = consulta($sql);

		return $resultado;
	}
?>