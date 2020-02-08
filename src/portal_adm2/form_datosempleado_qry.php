<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';

switch ($_POST['funcion']) {
    case 'buscar':
        buscar();
        break;
    case 'buscarr':
        buscarr();
        break;
}

function buscar()
{
    global $conexion;
    $sql = "select * from empleado where idEmpleado= " . $_POST["idEmpleado"] . ";";

    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}

function buscarr()
{
    global $conexion;
    $sql = "select * from empleado where DocumentoIdentidad= " . $_POST["DocumentoIdentidad"] . ";";

    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}
