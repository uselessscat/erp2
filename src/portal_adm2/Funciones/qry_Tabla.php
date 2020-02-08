<?php

require_once './conexion_mysql.php';

$tabla = $_POST['t'];

$sql = "SELECT * FROM " . $tabla . ";";
$result = mysqli_query($conexion, $sql);

//echo json_encode(array(array("asd" => "s"), array("asd" => "s")));

echo "[";
for ($i = 0; $tupla = mysqli_fetch_array($result, MYSQLI_ASSOC); $i++) {
    if ($i > 0) {
        echo ",";
    }
    echo json_encode($tupla);
}
echo "]";

exit;
