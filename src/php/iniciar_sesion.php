<?php

session_start();

// comprobar que desea cerrar session (TODO: quitar esto de aqui!)
if ($_REQUEST['sesion'] == "salir") {
    session_destroy();
    header("Location: ../index.php");
    exit;
}

// comenzar la sesion y comprobar si ha iniciado si no, echar...
if (isset($_SESSION['uid'])) {
    header('Location: ../index.php?pg=paginas/portal_trabajador');
} else {
    session_destroy();
}

require_once 'conexion_mysql.php';
$coneccion = ctar_nvl_0();

$sql = "SELECT idEmpleado , Contrasena , Login , DocumentoIdentidad , Nombres , ApellidoMaterno , ApellidoPaterno , Direccion FROM empleado WHERE Login = '{$_POST['lg_usuario']}' LIMIT 0 , 30;";
$key = "SELECT md5('{$_POST['lg_contrasena']}');";

$result = mysqli_query($coneccion, $sql);
$resultkey = mysqli_query($coneccion, $key);

// convertir respuesta => arreglo
$aresult = mysqli_fetch_array($result);
$aresultkey = mysqli_fetch_array($resultkey);

if (mysqli_num_rows($result) == 0) {
    // no hay usuario, enviar a no hay usuario (TODO: Mejorar esto)
    echo 'no hay usuario';
} else {
    if ($aresult['Contrasena'] != $aresultkey[0]) {
        echo 'contraseña incorrecta';
    } else {
        session_start();
        session_cache_expire(10); // 10 minutos -> no funciona

        $_SESSION['uid'] = $aresult['idEmpleado'];

        header('Location: ../index.php?pg=portal_trabajador');
    }
}

mysqli_close($coneccion);
