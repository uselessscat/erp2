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
	case 'buscar':buscar($_POST['DocumentoIdentidad']);break;
}

function cargar($id) {
  $sql = "select *,HOUR(HoraInicio) horainicio,MINUTE(HoraInicio) minutosinicio, HOUR(HoraFin) horafin,MINUTE(HoraFin) minutosfin from empleado e, contrato c,departamento d,datosempleado da, ciudad ciu, region r where e.idEmpleado=c.Empleado_idEmpleado and da.idEmpleado= e.idEmpleado and da.Departamento_idDepartamento=d.idDepartamento and e.Ciudad_idCiudad=ciu.idCiudad and r.idRegion=ciu.Region_idRegion;";

  $result = mysql_query($sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  $sql = "DELETE FROM  WHERE idempleado = " . $id . " LIMIT 1;";
  $result = mysql_query($sql);

  $error = mysql_error();
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}


function modificar() {
$sql2 = "SELECT idEmpleado from empleado WHERE DocumentoIdentidad= ".$_POST["DocumentoIdentidad"].";";
echo $sql2;
$result2 = mysql_query($sql2);
$datos= mysqli_fetch_array($result2);
	
 $sql = "UPDATE datosempleado SET Afp_idAfp= ". $_POST["idAfp"] . " where idEmpleado =".$datos["idEmpleado"].";";
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