<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['idAfp']);
    break;
  case 'eliminar': eliminar($_POST['idAfp']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar();
    break;
}

function cargar($id) {
  $sql = "SELECT * FROM afp WHERE idAfp = " . $id . ";";
  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  $sql = "DELETE FROM afp WHERE idAfp = " . $id . " LIMIT 1;";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}

function ingresar() {
  $sql = "INSERT INTO afp SET "
   . "idAfp = ".$_POST["idAfp"].", "
. "Rut = ".$_POST["Rut"].", "
. "Nombre = '".$_POST["Nombre"]."', "
. "Porcentaje = ".$_POST["Porcentaje"].", "
. "Estado = ".$_POST["Estado"].", "
. "Ciudad_idCiudad = ".$_POST["Ciudad_idCiudad"].";";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Ingresado correctamente";
}

function modificar() {
  $sql = "UPDATE afp SET "
. "Rut = ".$_POST["Rut"].", "
. "Nombre = '".$_POST["Nombre"]."', "
. "Porcentaje = ".$_POST["Porcentaje"].", "
. "Estado = ".$_POST["Estado"].", "
. "Ciudad_idCiudad = ".$_POST["Ciudad_idCiudad"]." WHERE idAfp = "
.$_POST["idAfp"].";";
  ;
  $result = mysql_query($sql);

  $error = mysql_error();
  if ($error != '') {
    echo $error;
  } else {

    echo "Actualizado correctamente";
  }
}

?>