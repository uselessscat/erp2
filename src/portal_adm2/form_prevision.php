<?php
// iniciar sesion y comprobar que esta registrado
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
        return "form_prevision.php";
    }

    function cargarDatos(id) {
        $.post("./Funciones/qry_TablaCondicionSimple.php", "t=previsionsalud&n=idPrevision&v=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#frm_idPrevision").attr("value", datos["idPrevision"]);
                $("#frm_Nombre").attr("value", datos["Nombre"]);
                $("#frm_Rut").attr("value", datos["Rut"]);
                $("#frm_Fono").attr("value", datos["Fono"]);
                $("#frm_Direccion").attr("value", datos["Direccion"]);
                $("#frm_Ciudad_idCiudad > option[value=" + datos["Ciudad_idCiudad"] + "]").attr('selected', true);
            });
    }
</script>
<script>
    $(document).ready(function() {
        $.post("./Funciones/generarSelect.php", "t=ciudad&v=idCiudad&n=Nombre",
            function(data) {
                $("#prevision_ciudad").html(data);
            }
        );
    });
</script>
<h2>Prevision de Salud</h2>
<hr>
<form name="f_prevision">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Prevision de salud</th>
        </tr>
        <tr>
            <td><label for="prevision_idPrevision">idPrevision</label></td>
            <td><span class="val_requerido"><input type="text" disabled="disabled" id="frm_idPrevision" /></span></td>
        </tr>
        <tr>
            <td><label for="prevision_Nombre">Nombre</label></td>
            <td><span class="val_requerido"><input type="text" id="frm_Nombre" /></span></td>
        </tr>
        <tr>
            <td><label for="prevision_Rut">Rut</label></td>
            <td><span class="val_requerido"><input type="text" id="frm_Rut" /></span></td>
        </tr>
        <tr>
            <td><label for="prevision_Estado">Estado</label></td>
            <td>
                <select name="prevision_Estado" id="prevision_Estado">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <table align="center">
                    <tr align="center">
                        <td><input type="button" id="btn_ingresar" value="Ingresar" onclick="ingresarDatos(capturarDatos())" /></td>
                        <td><input type="button" id="btn_modificar" value="Modificar" onclick="modificarDatos(capturarDatos())" /></td>
                        <td><input type="button" id="btn_eliminar" value="Eliminar" onclick="eliminarDatos('_t=previsiosalud&_pk=idprevision&-idprevision=' + $('#frm_idPrevision').val())" /></td>
                        <td><input type="button" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(), 'panel')" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<hr>

<?php
$tg_sql = "select p.idPrevision as 'Id Prevision',"
    . "p.Nombre as 'Nombre',Rut as 'Rut', Porcentaje, estado from previsionsalud p";
$tg_accion = "<a href = \"#\" onclick = \"cargarDatos(\$id)\"><img src = \"../imagen/tema/ico_aceptar1.png\" width = \"16\" height = \"16\" /></a> <a href = \"#\" onclick = \"eliminarDatos('_t=previsiosalud&_pk=idprevision&-idprevision=\$id')\"><img src = \"../imagen/tema/ico_aceptar0.png\" width = \"16\" height = \"16\" /></a></td>";
$tg_id = "Id Prevision";
include './Funciones/generarTablaXSql.php';
?>

</html>