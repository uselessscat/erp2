<?php

//conectar con la base datos
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';
?>
<script type="text/javascript">
    function getDir() {
        return "form_permisos.php";
    }

    function capturarDatos() {
        return "_t=empleado&_pk=idEmpleado&-idEmpleado=" + $("#frm_idEmpleado").val() +
            "&-NivelAdministrativo=" + $("#frm_nvadm").val();
    }

    function cargarDatos(id) {
        $.post("form_permisos_qry.php", "funcion=cargar&idEmpleado=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#frm_idEmpleado").attr("value", datos["idEmpleado"]);
                $("#frm_Login").attr("value", datos["Login"]);
                $("#frm_DocumentoIdentidad").attr("value", datos["DocumentoIdentidad"]);
                $("#frm_nvadm > option[value=" + datos["NivelAdministrativo"] + "]").attr('selected', true);
            });
    }
</script>

<h2>Permisos administrativos</h2>
<form name="f_permisos">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Permisos</th>
        </tr>
        <tr>
            <td><label for="frm_idEmpleado">idEmpleado</label></td>
            <td><input type="text" disabled="disabled" id="frm_idEmpleado" /></td>
        </tr>
        <tr>
            <td><label for="frm_Login">Login</label></td>
            <td><input type="text" disabled="disabled" id="frm_Login" /></td>
        </tr>
        <tr>
            <td><label for="frm_DocumentoIdentidad">DocumentoIdentidad</label></td>
            <td><input type="text" disabled="disabled" id="frm_DocumentoIdentidad" /></td>
        </tr>
        <tr>
            <td><label for="frm_nvadm">NivelAdministrativo</label></td>
            <td><select name="frm_nvadm" id="frm_nvadm">
                    <option value="0">Administrador</option>
                    <option value="1">Jefazo</option>
                    <option value="2">Usuario con permisos</option>
                    <option value="3" selected="selected">Trabajador(Sin permisos administrativos)</option>
                </select></td>
        </tr>
        <tr>
            <td colspan="2">
                <table align="center">
                    <tr align="center">
                        <td><input type="button" id="btn_modificar" value="Modificar" onclick="modificarDatos(capturarDatos())" /></td>
                        <td><input type="button" id="btn_Quitar_Permisos" value="Quitar Permisos" onclick="modificarDatos('_t=empleado&_pk=idEmpelado&-idEmpleado=' + $('#frm_idEmpleado').val() + '&-NivelAdministrativo=3')" /></td>
                        <td><input type="button" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(),'panel')" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<hr>
<?php

$tg_sql = "select idEmpleado as 'Id',"
    . "Login as 'Login',"
    . "DocumentoIdentidad as 'Rut',"
    . "NivelAdministrativo as 'Nivel de Permisos' from empleado;";
$tg_accion = "<a href=\"#\" onclick=\"cargarDatos(\$id)\"><img src=\"../imagen/tema/ico_aceptar1.png\" width=\"16\" height=\"16\" /></a>";
$tg_id = "Id";
include './Funciones/generarTablaXSql.php';
?>