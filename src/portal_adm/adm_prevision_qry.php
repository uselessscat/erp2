<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['idPrevision']);
    break;
  case 'eliminar': eliminar($_POST['idPrevision']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar($_POST['idPrevision']);
    break;
}

function cargar($id) {
  $sql = "SELECT * FROM previsiosalud WHERE idPrevision = " . $id . ";";
  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  $sql = "DELETE FROM previsiosalud WHERE idPrevision = " . $id . " LIMIT 1;";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}

function ingresar() {
  $sql = "INSERT INTO previsiosalud SET "
    ."idPrevision = ".$_POST["idPrevision"].", "
."Nombre = '".$_POST["Nombre"]."', "
."Rut = ".$_POST["Rut"].", "
."Fono = ".$_POST["Fono"].", "
."Direccion = '".$_POST["Direccion"]."', "
."Ciudad_idCiudad = ".$_POST["Ciudad_idCiudad"].";";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Ingresado correctamente";
}

function modificar($id) {
  $sql = "UPDATE previsiosalud SET "
."Nombre = '".$_POST["Nombre"]."', "
."Rut = ".$_POST["Rut"].", "
."Fono = ".$_POST["Fono"].", "
."Direccion = '".$_POST["Direccion"]."', "
."Ciudad_idCiudad = ".$_POST["Ciudad_idCiudad"]
		. " WHERE idPrevision = ".$id.";";
  $result = mysql_query($sql);

  $error = mysql_error();
  if ($error != '') {
    echo $error;
  } else {

    echo "Actualizado correctamente";
  }
}

?>