<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['idCentroCosto']);
    break;
  case 'eliminar': eliminar($_POST['idCentroCosto']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar();
    break;
	case 'buscar':buscar($_POST['idEmpleado']);break;
}

function cargar($id) {
  global $conexion;
  $sql = "SELECT *,DATE_FORMAT(Fecha,'%d-%m-%Y') as Fechaf FROM centrocosto c, empleado e WHERE c.idCentroCosto =  " . $id . " ;";
  
  
  $result = mysqli_query($conexion, $sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  global $conexion;
  $sql = "DELETE FROM centrocosto WHERE idCentroCosto = " . $id . " LIMIT 1;";
  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}

function ingresar() {
  global $conexion;
  $sql = "INSERT INTO centrocosto SET "
          . "idCentroCosto = " . $_POST["idCentroCosto"] . ","
          . "Nombre = '" . $_POST["Nombre"] . "',"
          . "Encargado_idEmpleado = " . $_POST["Encargado_idEmpleado"] . ","
          . "CentroCostoPadre = " . $_POST["CentroCostoPadre"] . ","
          . "Fecha =STR_TO_DATE( '" . $_POST["Fecha"] . "','%d-%m-%Y');";


  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
  echo ($error != '') ? $error : "Ingresado correctamente";
}

function modificar() {
  global $conexion;
  $sql = "UPDATE centrocosto SET "
          . "Nombre = '" . $_POST["Nombre"] . "',"
          . "Encargado_idEmpleado = " . $_POST["Encargado_idEmpleado"] . ","
          . "CentroCostoPadre = " . $_POST["CentroCostoPadre"] . ","
          . "Fecha =STR_TO_DATE( '" . $_POST["Fecha"] . "','%d-%m-%Y') WHERE "
          . "idCentroCosto = " . $_POST["idCentroCosto"] . ";";

  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
  echo ($error != '') ? $error : "Actualizado correctamente";
}
function buscar() {
  global $conexion;
	$sql= "select * from empleado where idEmpleado= ".$_POST["idEmpleado"].";";

   $result = mysqli_query($conexion, $sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
	}

?>