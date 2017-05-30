<?php
	require_once($_SERVER['DOCUMENT_ROOT'] ."/ABD/php/config/connection.php");
	
	// Realiza una consulta en la base de datos
	function consulta($sql){
		//conectamos con la base de datos
		$conn = conectar();
		//Realizamos la consulta y almacenamos su valor
		$resultado = realiza_consulta($conn, $sql);
		//Cerramos la conexión
		cerrar_conexion($conn);

		return $resultado;
	}
?>