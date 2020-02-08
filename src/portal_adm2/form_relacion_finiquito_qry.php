<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';

switch ($_POST['funcion']) {
    case 'cargar':
        cargar($_POST['idEmpleado']);
        break;
    case 'eliminar':
        eliminar($_POST['idEmpleado']);
        break;
    case 'ingresar':
        ingresar();
        break;
    case 'modificar':
        modificar();
        break;
}

function cargar($id)
{
    global $conexion;
    $sql = "SELECT *,DATE_FORMAT(FechaTerminoContrato,'%d-%m-%Y') as fechaTerminoCont,DATE_FORMAT(FechaPagoFiniquito,'%d-%m-%Y') as fechaPagoFiniquito,DATEDIFF(c.Fecha,f.FechaTerminoContrato) dias FROM finiquito f, empleado e,contrato c WHERE e.idEmpleado  = " . $id . " and c.Empleado_idEmpleado = e.idEmpleado and f.Contrato = e.idEmpleado;";

    $result = mysqli_query($conexion, $sql);
    echo json_encode(mysqli_fetch_array($result));
    exit;
}

function eliminar($id)
{
    global $conexion;
    $sql = "DELETE FROM finiquito WHERE Contrato  = " . $id . " LIMIT 1;";
    $result = mysqli_query($conexion, $sql);

    $error = mysqli_error($conexion);
    echo ($error != '') ? $error : "Eliminado correctamente";

    // comprobar dependencias de fks
    exit;
}

function ingresar()
{
    global $conexion;
    $sql = "INSERT INTO finiquito SET "
        . "Contrato = " . $_POST['Contrato'] . ","
        . "FechaTerminoContrato = STR_TO_DATE('" . $_POST['FechaTerminoContrato'] . "','%d-%m-%Y'),"
        . "FechaPagoFiniquito = STR_TO_DATE('" . $_POST['FechaPagoFiniquito'] . "','%d-%m-%Y'),"
        . "Finiquito = " . $_POST['Finiquito'] . ";";


    $result = mysqli_query($conexion, $sql);

    $error = mysqli_error($conexion);
    echo ($error != '') ? $error : "Ingresado correctamente";
}

function modificar()
{
    global $conexion;
    $sql = "UPDATE finiquito SET "
        . "Contrato = " . $_POST['Contrato'] . ","
        . "FechaTerminoContrato = '" . $_POST['FechaTerminoContrato'] . "',"
        . "FechaPagoFiniquito = '" . $_POST['FechaPagoFiniquito'] . "',"
        . "Finiquito = " . $_POST['Finiquito'] . ";";

    $result = mysqli_query($conexion, $sql);

    $error = mysqli_error($conexion);
    echo ($error != '') ? $error : "Actualizado correctamente";
}

/*
  frm_DocumentoIdentidad
  frm_Nombres
  frm_ApellidoPaterno
  frm_ApellidoMaterno
  frm_FechaNacimiento
  frm_Direccion
  frm_Pais_idPais
  frm_Ciudad_idCiudad
  frm_C_FechaInicioContrato
  frm_FechaTerminoContrato
  frm_FechaPagoFiniquito
  frm_C_Sueldo
  frm_Finiquito
 */
