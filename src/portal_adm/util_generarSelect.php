<?php

// generar opcion de select, como el de la katy pero 
// generico adaptado para las dependencias de selects

$tabla = $_POST['t']; //nombre de la tabla
$campovalor = $_POST['v']; // nombre del campo que contiene el value
$camponombre = $_POST['n']; // nombre del campo que contiene la etiqueta del option
$camporeferencia = $_POST['r']; // nombre del campo de referencia, si este select depende de otro
$referencia = $_POST['rv']; // valor del campo referencia
$valor = $_POST['val'];

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

if ($_POST['jn'] != 'true') {
  $sql = "SELECT " . $campovalor . " , " . $camponombre . " FROM " . $tabla . " ";
  if ($camporeferencia && $referencia) {
    $sql.= "WHERE " . $camporeferencia . "=" . $referencia . ";";
  } else {
    $sql .= ";";
  }

  $result = mysqli_query($conexion, $sql);

// el seleccione por defecto = -1
  echo "<option value=\"-1\">Seleccione una opcion</option>";
  while ($tupla = mysqli_fetch_array($result)) {
    echo "<option value=" . $tupla[$campovalor] . ">" . $tupla[$camponombre] . "</option>\n";
  }
} else {
  $sql = "SELECT " . $camporeferencia . " FROM " . $tabla . " WHERE " . $campovalor . " = " . $valor . ";";
  $result = mysqli_query($conexion, $sql);

  $arr = mysqli_fetch_array($result);
  echo $arr[$camporeferencia];
}
?>