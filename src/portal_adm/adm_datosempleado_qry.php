<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['idempleado']);
    break;
  case 'eliminar': eliminar($_POST['idempleado']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar();
    break;
	case 'buscar':buscar();break;
	case 'buscarr':buscarr();break;
}

function cargar($id) {
  $sql = "SELECT * FROM datosempleado da, empleado e  WHERE da.idempleado = " . $id . " and da.idEmpleado=e.idEmpleado;";

  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  $sql = "DELETE FROM datosempleado WHERE idempleado = " . $id . " LIMIT 1;";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}

function ingresar() {
  $sql = "INSERT INTO datosempleado SET "
          . "idEmpleado = " . $_POST["idempleado"] . ","
          . "Afp_idAfp = " . $_POST["afp"] . ","
          . "Isapre_idIsapre = " . $_POST["isapre"] . ","
          . "Isapre_Porcentaje = " . $_POST["isapre_porcentaje"] . ","
          . "CentroCosto_idCentroCosto = " . $_POST["centrocosto"] . ","
          . "Departamento_idDepartamento = " . $_POST["departamento"] . "";


  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Ingresado correctamente";
}

function modificar() {
  $sql = "UPDATE datosempleado SET "
          . "idEmpleado = " . $_POST["idempleado"] . ","
          . "Afp_idAfp = " . $_POST["afp"] . ","
          . "Isapre_idIsapre = " . $_POST["isapre"] . ","
          . "Isapre_Porcentaje = " . $_POST["isapre_porcentaje"] . ","
          . "CentroCosto_idCentroCosto = " . $_POST["centrocosto"] . ","
          . "Departamento_idDepartamento = " . $_POST["departamento"] . " "
          . "WHERE idempleado = " . $_POST["idempleado"] . ";";

  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Actualizado correctamente";
}
function buscar() {
	$sql= "select * from empleado where idEmpleado= ".$_POST["idEmpleado"].";";

   $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
	}
	function buscarr() {
	$sql= "select * from empleado where DocumentoIdentidad= ".$_POST["DocumentoIdentidad"].";";

   $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
	}

?>