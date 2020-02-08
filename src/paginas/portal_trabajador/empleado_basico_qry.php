<?php

session_start();

require '../../php/conexion_mysql.php';

$conexion = ctar_nvl_2();

$file = 0;

if ($_FILES['frm_archivo']['error'] === UPLOAD_ERR_OK) {
    $file = 1;
    $ext = pathinfo($_FILES['frm_archivo']['name'], PATHINFO_EXTENSION);

    move_uploaded_file($_FILES['frm_archivo']['tmp_name'], "../../imagen/usuario/{$_SESSION['uid']}.$ext");
}


$sql = "UPDATE empleado SET
    EstadoCivil = '{$_POST['frm_civil']}',
    Direccion = '{$_POST['frm_direccion']}',
    Login = '{$_POST['frm_usuario']}',
    Estado = {$_POST['frm_estado']},
    Ciudad_idCiudad = '{$_POST['frm_ciudad']}',
    Contrasena = md5('{$_POST['frm_clave']}'),
    TelefonoMovil = '{$_POST['frm_movil']}',
    TelefonoFijo = '{$_POST['frm_fijo']}',
    FechaNacimiento = '{$_POST['frm_fnac']}',
    Departamento_idDepartamento = '{$_POST['frm_nacionalidad']}',
    Foto = {$file}
    where idEmpleado = {$_SESSION['uid']};";

$result = mysqli_query($conexion, $sql);

mysqli_close($conexion);

// datos modificados Pagina
header('Location: /index.php?pg=portal_trabajador');
