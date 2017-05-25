<?php
	function conecta_servidor($host, $usuario){
		$link = mysql_connect($host, $usuario, '')
		or die('No se pudo conectar: ' . mysql_error());
		
		return $link;
	}

	function conecta_BD($bd){
		//echo 'Connected successfully<br>';
		mysql_select_db($bd) or die('No se pudo seleccionar la base de datos');
	}


















	function desconectar($conexion)
	{
		if($conexion)
		{
			$ok = @mysqli_close($conexion);
			/*
			if($ok)
			{
				echo 'Desconexion realizada correctamente. <br>';
			}
			else
			{
				echo 'Fallo en la desconexion. <br>';
			}
			*/
		}
		else
		{
			echo 'Conexion no abierta. <br>';
		}
	}

	function realiza_consulta($db, $consulta)
	{
		//Realizamos la query
		$query = mysqli_query($db, $consulta);
		//SOLO DEPURACION: Muestra errores en la consulta
		echo(mysqli_error($db));
		return $query;
	}
?>