<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';

switch ($_POST['funcion']) {
    case 'cargar':
        cargar($_POST['idPrevision']);
        break;
}

function cargar($id)
{
    global $conexion;
    $sql = "SELECT * FROM previsiosalud WHERE idPrevision = " . $id . ";";
    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}
