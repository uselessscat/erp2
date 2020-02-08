<?php
header('Content-Type: text/html; charset=ISO-8859-1');
require_once './conexion_mysql.php';

$tabla = $_POST['t']; //nombre de la tabla
$campovalor = $_POST['v']; // nombre del campo que contiene el value
$camponombre = $_POST['n']; // nombre del campo que contiene la etiqueta del option

$sql = "SELECT " . $campovalor . " , " . $camponombre . " FROM " . $tabla . " ";
if ($camporeferencia && $referencia) {
    $sql .= "WHERE " . $camporeferencia . "=" . $referencia . ";";
} else {
    $sql .= ";";
}

$result = mysqli_query($conexion, $sql);

// el seleccione por defecto = -1
echo "<option value=\"-1\">Seleccione una opcion</option>";
while ($tupla = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    echo "<option value=" . $tupla[$campovalor] . ">" . $tupla[$camponombre] . "</option>\n";
}
