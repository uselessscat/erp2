<?php

require_once './conexion_mysql.php';

$tabla = $_POST['t'];
$campovalor = $_POST['v'];
$camponombre = $_POST['n'];

if ($_POST['a']) {
    $adicionales = " , " . stripslashes($_POST['a']);
} else {
    $adicionales = "";
}

$sql = "SELECT * " . $adicionales . " FROM " . $tabla . " WHERE " . $camponombre . " = " . $campovalor . ";";
$result = mysqli_query($conexion, $sql);
echo json_encode(mysqli_fetch_array($result));
exit;
