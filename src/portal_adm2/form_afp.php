<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}

require_once './Funciones/conexion_mysql.php';

if (isset($_POST['datos'])) {
    $datos = json_decode(stripslashes($_POST['datos']));

    switch ($datos->funcion) {
        case "insert": {
                $sql = sprintf("INSERT INTO afp (idAfp, Rut, Nombre, Porcentaje, Estado) VALUES (%s, %s, '%s', %s, %s)", $datos->idAfp, $datos->Rut, $datos->Nombre, $datos->Porcentaje, $datos->Estado);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Ingresado correctamente";
            }
            break;

        case "update": {
                $sql = sprintf("UPDATE afp SET Nombre='%s', Rut=%s, Porcentaje=%s, Estado=%s WHERE idAfp=%s", $datos->Nombre, $datos->Rut, $datos->Porcentaje, $datos->Estado, $datos->idAfp);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Modificado correctamente";
            }
            break;

        case "delete": {
                $sql = sprintf("DELETE FROM afp WHERE idAfp=%s", $datos->idAfp);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Eliminado correctamente";
            }
            break;
    }
    exit;
}
?>
<script>
    function getDir() {
        return "form_afp.php";
    }

    function cargarDatos(id) {
        $.post("./Funciones/qry_TablaCondicionSimple.php", "t=afp&n=idAfp&v=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#afp_idAfp").attr("value", datos["idAfp"]);
                $("#afp_Rut").attr("value", datos["Rut"]);
                $("#afp_Nombre").attr("value", datos["Nombre"]);
                $("#afp_Porcentaje").attr("value", datos["Porcentaje"]);
            });
    }
</script>
<h2>AFP</h2>
<hr>
<table class="tablaformulario">
    <tr>
        <th colspan="2">AFP</th>
    </tr>
    <tr>
        <td><label for="afp_idAfp">idAfp</label></td>
        <td><span class="validacion"><input type="text" id="afp_idAfp" /></span></td>
    </tr>
    <tr>
        <td><label for="afp_Nombre">Nombre</label></td>
        <td><span class="validacion"><input type="text" id="afp_Nombre" /></span></td>
    </tr>
    <tr>
        <td><label for="afp_Rut">Rut</label></td>
        <td><span class="validacion"><input type="text" id="afp_Rut" /></span></td>
    </tr>
    <tr>
        <td><label for="afp_Porcentaje">Porcentaje</label></td>
        <td><span class="validacion"><input type="text" id="afp_Porcentaje" /></span></td>
    </tr>
    <tr>
        <td><label for="afp_Estado">Estado</label></td>
        <td><span class="validacion"><select id="afp_Estado">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select></span></td>
    </tr>
    <tr>
        <td colspan="2">
            <table align="center">
                <tr>
                    <td><input type="button" id="btn_ingresar" value="Ingresar" onclick="enviar(new select_afp('insert'))" /></td>
                    <td><input type="button" id="btn_modificar" value="Modificar" onclick="enviar(new select_afp('update'))" /></td>
                    <td><input type="button" id="btn_eliminar" value="Eliminar" onclick="enviar(new select_afp('delete'))" /></td>
                    <td><input type="button" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(), 'panel')" /></td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<hr>
<?php

$tg_sql = "select "
    . "a.idAfp as Codigo,"
    . "a.Rut as Rut,"
    . "a.Nombre as 'Nombre AFP', "
    . "a.Porcentaje as Porcentaje,"
    . "a.Estado as Estado "
    . "from afp a";
$tg_id = "Codigo";
$tg_accion = "<a href = \"#\" onclick = \"cargarDatos(\$id)\"><img src = \"../imagen/tema/ico_aceptar1.png\" width = \"16\" height = \"16\" /></a><a href = \"#\" onclick = \"eliminarDatos('_t=afp&_pk=idAfp&-idAfp=\$id')\"><img src = \"../imagen/tema/ico_aceptar0.png\" width = \"16\" height = \"16\" /></a>";
$tg_ncv = '0';
include './Funciones/generarTablaXSql.php';
?>