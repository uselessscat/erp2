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
}

function cargar($id) {
  $sql = "SELECT * FROM previsiosalud i, empleado e,contrato c, datosempleado da  WHERE e.idEmpleado  = ". $id ." and and c.Empleado_idEmpleado=e.idEmpleado and c.Empleado_idEmpleado = i.idPrevision and i.idPrevision=da.idEmpleado;";
  
  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function modificar() {
$sql2 = "SELECT idEmpleado from empleado WHERE DocumentoIdentidad= ".$_POST["RutEmpleado"].";";
echo $sql2;
$result2 = mysql_query($sql2);
$datos= mysqli_fetch_array($result2);
	
 $sql = "UPDATE datosempleado SET Isapre_idIsapre= ". $_POST["IdIsapre"] . " where idEmpleado =".$datos["idEmpleado"].";";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Actualizado correctamente";
}

function buscar() {
	$sql= "select * from empleado e, pais p where e.Pais_idPais=p.idPais and e.DocumentoIdentidad= ".$_POST["DocumentoIdentidad"]."";
	
   $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
	}

?>



