<?php

session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';

switch ($_POST['funcion']) {
    case 'cargar':
        cargar($_POST['idempleado']);
        break;
    case 'buscar':
        buscar($_POST['DocumentoIdentidad']);
        break;
}

function cargar($id)
{
    global $conexion;
    $sql = "select *,"
        . "HOUR(HoraInicio) horainicio,"
        . "MINUTE(HoraInicio) minutosinicio, "
        . "HOUR(HoraFin) horafin,"
        . "MINUTE(HoraFin) minutosfin "
        . "from empleado e, contrato c,departamento d, empleado2 da, ciudad ciu, region r "
        . "where e.idEmpleado=c.idEmpleado and da.idEmpleado= e.idEmpleado and da.Departamento_idDepartamento=d.idDepartamento and e.Ciudad_idCiudad=ciu.idCiudad and r.idRegion=ciu.Region_idRegion;";

    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}

function buscar()
{
    global $conexion;
    $sql = "select * from empleado e, pais p where e.Pais_idPais=p.idPais and e.DocumentoIdentidad= " . $_POST["DocumentoIdentidad"] . "";

    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}
