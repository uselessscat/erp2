<?php
session_start();
require_once "./conexion_mysql.php";

$sql = "SELECT idEmpleado , Contrasena , Login , DocumentoIdentidad , Nombres , ApellidoMaterno , ApellidoPaterno, NivelAdministrativo, Estado FROM empleado WHERE Login = '" . $_POST["usuario"] . "' LIMIT 1;";
$key = "SELECT md5('" . $_POST["contrasena"] . "');";

$result = mysqli_query($conexion, $sql);
$resultkey = mysqli_query($conexion, $key);

// convertir respuesta => arreglo
$aresult = mysqli_fetch_array($result);
$aresultkey = mysqli_fetch_array($resultkey);

if (mysqli_num_rows($result) == 0 || $aresult['Contrasena'] != $aresultkey[0] || $aresult['Estado'] <= 0) {
?>
    <h3>Información</h3>
    <p>El usuario o contraseña no coinciden, no tiene los permisos
        para entrar o su cuenta esta clausurada, para obtener mas información contacte al administrador.</p>
    <a href="#" onclick="cargar('./login.php', 'panel')">volver</a>
<?php
} else if ($aresult['NivelAdministrativo'] > 2) {
?>
    <h3>Información</h3>
    <p>El usuario que ha elegido para ingresar no tiene los permisos
        necesarios para estar en este sitio, para obtener mas información contacte al administrador.</p>
    <a href="#" onclick="cargar('./login.php', 'panel')">volver</a>
<?php
} else {
    session_start();
    session_cache_expire(10); // 10 minutos -> no funciona
    $_SESSION['aid'] = $aresult['idEmpleado'];
    $_SESSION['admlv'] = $aresult['NivelAdministrativo'];
    $_SESSION['nombre'] = $aresult['Nombres'];
    $_SESSION['login'] = $aresult['Login'];
    $_SESSION['apellido'] = $aresult['ApellidoPaterno'];
?>
    <h3>Ha iniciado Sesion</h3>
    <p>Comience a navegar entre las opciones.</p>
<?php
}

mysqli_close($conexion);
?>