<?php
	require_once("../php/conexion_mysql.php");
	$conexion = ctar_nvl_0();

$tabla = $_POST['t'];
$campovalor = $_POST['v']; 
$camponombre = $_POST['n'];

$sql = "SELECT * FROM ".$tabla." WHERE ".$camponombre." = ".$campovalor.";" ;
$result = mysqli_query($conexion, $sql);
echo json_encode(mysqli_fetch_array($result));
  exit;
?>