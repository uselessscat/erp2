<?php

require_once("../php/conexion_mysql.php");
$conexion = ctar_nvl_0();

switch ($_POST['funcion']) {
  case 'cargar': cargar($_POST['id']);
    break;
  case 'eliminar': eliminar($_POST['id']);
    break;
  case 'ingresar': ingresar();
    break;
  case 'modificar':modificar();
    break;
}

function cargar($id){
  global $conexion;
  $sql = "SELECT *,DATE_FORMAT(FechaNacimiento,'%d-%m-%Y') as Fechanac FROM empleado WHERE idEmpleado = " . $id . ";";
  $result = mysqli_query($conexion, $sql);
  echo json_encode(mysqli_fetch_array($result));
  exit;
}

function eliminar($id) {
  global $conexion;
  $sql = "DELETE FROM empleado WHERE idEmpleado = " . $id . " LIMIT 1;";
  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
  echo ($error != '') ? $error : "Eliminado correctamente";

// comprobar dependencias de fks
  exit;
}

function ingresar() {
  global $conexion;
  $sql = "INSERT INTO empleado SET "
          . "DocumentoIdentidad = '" . $_POST['DocumentoIdentidad'] . "', "
          . "Nombres = '" . $_POST['Nombres'] . "', "
          . "ApellidoPaterno = '" . $_POST['ApellidoPaterno'] . "', "
          . "ApellidoMaterno = '" . $_POST['ApellidoMaterno'] . "', "
          . "FechaNacimiento =STR_TO_DATE( '" . $_POST['FechaNacimiento'] . "','%d-%m-%Y'), "
          . "Direccion = '" . $_POST['Direccion'] . "', "
          . "TelefonoMovil = '" . $_POST['TelefonoMovil'] . "', "
          . "TelefonoFijo = '" . $_POST['TelefonoFijo'] . "', "
          . "Email = '" . $_POST['Email'] . "', "
          . "OtroContacto = '" . $_POST['OtroContacto'] . "', "
          . "Login = '" . $_POST['Login'] . "', "
          . "Contrasena = md5('" . $Contrasena['Contrasena'] . "'), "
          . "Sexo = '" . $_POST['Sexo'] . "', "
          . "EstadoCivil = " . $_POST['EstadoCivil'] . ", "
          . "Pais_idPais = " . $_POST['Pais_idPais'] . ", "
          . "Ciudad_idCiudad = " . $_POST['Ciudad_idCiudad'] . ", "     
          . "Estado = " . $_POST['Estado'] . ", "
          . "NivelAdministrativo = " . $_POST['NivelAdministrativo']. ", "
		  . "Fotografia ='".$_FILES ["Fotografia"]["name"]."'";
  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
	if($error == ''){
		echo  "Ingresado correctamente";
		move_uploaded_file($_FILES["frm_archivo"]["tmp_name"],"../imagen/usuario/".$_FILES ["frm_archivo"]["name"]);
	}else{
		echo $error;
	}
}

function modificar() {
  global $conexion;
  $sql = "UPDATE empleado SET "
          . "DocumentoIdentidad = '" . $_POST['DocumentoIdentidad'] . "', "
          . "Nombres = '" . $_POST['Nombres'] . "', "
          . "ApellidoPaterno = '" . $_POST['ApellidoPaterno'] . "', "
          . "ApellidoMaterno = '" . $_POST['ApellidoMaterno'] . "', "
         . "FechaNacimiento =STR_TO_DATE( '" . $_POST['FechaNacimiento'] . "','%d-%m-%Y'), "
          . "Direccion = '" . $_POST['Direccion'] . "', "
          . "TelefonoMovil = '" . $_POST['TelefonoMovil'] . "', "
          . "TelefonoFijo = '" . $_POST['TelefonoFijo'] . "', "
          . "Email = '" . $_POST['Email'] . "', "
          . "OtroContacto = '" . $_POST['OtroContacto'] . "', "
          . "Login = '" . $_POST['Login'] . "', "
          . (($Contrasena['Contrasena']) ? "Contrasena = md5('" . $Contrasena['Contrasena'] . "'), " : "")
          . "Sexo = '" . $_POST['Sexo'] . "', "
          . "EstadoCivil = " . $_POST['EstadoCivil'] . ", "
          . "Pais_idPais = " . $_POST['Pais_idPais'] . ", "
          . "Ciudad_idCiudad = " . $_POST['Ciudad_idCiudad'] . ", "
         . "Fotografia ='".$_FILES ["Fotografia"]["name"]."', "
          . "Estado = " . $_POST['Estado'] . ", "
          . "NivelAdministrativo = " . $_POST['NivelAdministrativo'] . " "
          . "WHERE idEmpleado = " . $_POST['idEmpleado'] . ";";
  $result = mysqli_query($conexion, $sql);

  $error = mysqli_error($conexion);
	if($error == ''){
		echo  "Ingresado correctamente";
		move_uploaded_file($_FILES["frm_archivo"]["tmp_name"],"../imagen/usuario/".$_FILES ["frm_archivo"]["name"]);
	}else{
		echo $error;
	}
}

?>