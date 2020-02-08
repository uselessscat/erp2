<?php
session_start();

// para cerrar sesion
if($_GET['sesion']=='cerrar'){
	session_destroy();
	header('Location: index.php');
	exit;
}

require_once("../php/conexion_mysql.php");
$coneccion = ctar_nvl_0();

$sql =  "SELECT idEmpleado , Contrasena , Login , DocumentoIdentidad , Nombres , ApellidoMaterno , ApellidoPaterno, NivelAdministrativo FROM empleado WHERE Login = '".$_POST["usuario"]."' LIMIT 1;"; 
$key = "SELECT md5('".$_POST["contrasena"]."');";

$result = mysqli_query( $coneccion, $sql);
$resultkey =  mysqli_query( $coneccion, $key);

// convertir respuesta => arreglo
$aresult = mysqli_fetch_array($result);
$aresultkey = mysqli_fetch_array($resultkey);

if (mysqli_num_rows( $result) == 0){
	// no hay usuario, enviar a no hay usuario (TODO: Mejorar esto)
	echo "no hay usuario";
}else{
	if ($aresult['Contrasena'] != $aresultkey[0]){
		echo "contraseña incorrecta";
	}else {
		session_start();
		session_cache_expire(10); // 10 minutos -> no funciona
		$_SESSION['aid'] = $aresult['idEmpleado'];
		$_SESSION['admlv'] = $aresult['NivelAdministrativo'];
		$_SESSION['nombre'] = $aresult['Nombres'];
		$_SESSION['login'] = $aresult['Login'];
		$_SESSION['apellido'] = $aresult['ApellidoPaterno'];
		
		header("Location: index.php");
	}
}

mysqli_close($coneccion);

?>