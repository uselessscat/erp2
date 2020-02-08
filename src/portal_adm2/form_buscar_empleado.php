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
    function buscar() {
        var sql = "select idEmpleado as Id, DocumentoIdentidad as Rut," +
            "concat(Nombres,' ',ApellidoPaterno,' ',ApellidoMaterno) as Nombre," +
            "Login as NombreUsuario from empleado where";
        switch ($('input:radio[name=tipo]:checked').val()) {
            case "1":
                sql += " Nombres like '%" + $("#frm_buscar").val() + "%' or " +
                    "ApellidoPaterno like '%" + $("#frm_buscar").val() + "%' or " +
                    "ApellidoMaterno like '%" + $("#frm_buscar").val() + "%';";
                break;
            case "2":
                sql += " DocumentoIdentidad = " + $("#frm_buscar").val() + ";";
                break;

        }

        $.post("./Funciones/generarSqlXJs.php", "tg_sql=" + sql, function(datos) {
            $("#rb").html(datos);
        });
    }
</script>
<h2>Busqueda de Trabajador</h2>
<hr>
<table class="tablaformulario">
    <tr>
        <td><input type="text" name="frm_buscar" id="frm_buscar"></td>
        <td><input type="button" name="btn_buscar" id="btn_buscar" value="Buscar" onClick="buscar();"></td>
    </tr>
    <tr>
        <td>
            <label>
                <input name="tipo" type="radio" id="tipo_0" value="1" checked="CHECKED">
                Nombre</label>
            <label>
                <input type="radio" name="tipo" value="2" id="tipo_1">
                Rut</label>
            <br />
        </td>
        <td>&nbsp;</td>
    </tr>
</table>

<hr>
<div id="rb"></div>