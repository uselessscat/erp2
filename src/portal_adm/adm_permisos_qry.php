<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['idEmpleado']);
    break;
  case 'quitar': quitar($_POST['idEmpleado']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar($_POST['idEmpleado']);
    break;
}

function cargar($id) {
  $sql = "SELECT * FROM empleado WHERE idEmpleado = " . $id . ";";
  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}
function modificar($id) {
  $sql = "UPDATE empleado SET "
."NivelAdministrativo = '".$_POST["NivelAdministrativo"]."'"
. " WHERE idEmpleado = ".$id.";";
  $result = mysql_query($sql);

  $error = mysql_error();
  if ($error != '') {
    echo $error;
  } else {

    echo "Actualizado correctamente";
  }
}

  function quitar($id){
	  
	   $sql = "UPDATE empleado SET NivelAdministrativo= 3 where idEmpleado=".$id."
;";	  
  $result = mysql_query($sql);

  $error = mysql_error();
  if ($error != '') {
    echo $error;
  } else {

    echo "Actualizado correctamente";
  }
	  
	  }


?>