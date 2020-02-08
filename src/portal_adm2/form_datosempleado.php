<?php

//conectar con la base datos
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
                $sql = sprintf("INSERT INTO empleado2 (idEmpleado, Contrato_idContrato, Afp_idAfp, PrevisionSalud_idPrevision, PrevisionPorcentage, Departamento_idDepartamento, CentroCosto_idCentroCosto) VALUES (%s, %s, %s, %s, %s, %s, %s)", $datos->idEmpleado, $datos->Contrato_idContrato, $datos->Afp_idAfp, $datos->PrevisionSalud_idPrevision, $datos->PrevisionPorcentage, $datos->Departamento_idDepartamento, $datos->CentroCosto_idCentroCosto);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Ingresado correctamente";
            }
            break;

        case "update": {
                $sql = sprintf("UPDATE empleado2 SET Contrato_idContrato=%s, Afp_idAfp=%s, PrevisionSalud_idPrevision=%s, PrevisionPorcentage=%s, Departamento_idDepartamento=%s, CentroCosto_idCentroCosto=%s WHERE idEmpleado=%s", $datos->Contrato_idContrato, $datos->Afp_idAfp, $datos->PrevisionSalud_idPrevision, $datos->PrevisionPorcentage, $datos->Departamento_idDepartamento, $datos->CentroCosto_idCentroCosto, $datos->idEmpleado);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Modificado correctamente";
            }
            break;

        case "delete": {
                $sql = sprintf("DELETE FROM empleado2 WHERE idEmpleado=%s", $datos->idEmpleado);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Eliminado correctamente";
            }
            break;
    }
    exit;
}
?>
<script type="text/javascript">
    function getDir() {
        return 'form_datosempleado.php';
    }

    function cargarDatos(id) {
        $.post("./Funciones/qry_TablaCondicionSimple.php", "t=empleado2&n=idempleado&v=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#frm_idempleado").attr("value", datos["idEmpleado"]);
                $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
                $("#frm_nombre").attr("value", datos["Nombres"]);
                $("#frm_isapre_porcentaje").attr("value", datos["Isapre_Porcentaje"]);

                $("#frm_afp > option[value=" + datos["Afp_idAfp"] + "]").attr('selected', true);
                $("#frm_isapre > option[value=" + datos["Isapre_idIsapre"] + "]").attr('selected', true);
                $("#frm_centrocosto > option[value=" + datos["CentroCosto_idCentroCosto"] + "]").attr('selected', true);
                $("#frm_departamento > option[value=" + datos["Departamento_idDepartamento"] + "]").attr('selected', true);
            }
        );
    }

    function buscar(id) {
        $.post("form_datosempleado_qry.php", "funcion=buscar&idEmpleado=" + $("#frm_idempleado").val(),
            function(data) {
                var datos = $.parseJSON(data);
                $("#frm_idempleado").attr("value", datos["idEmpleado"]);
                $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
                $("#frm_nombre").attr("value", datos["Nombres"]);
            });
    }

    function buscarr(id) {
        $.post("form_datosempleado_qry.php", "funcion=buscarr&DocumentoIdentidad=" + $("#frm_rut").val(),
            function(data) {
                var datos = $.parseJSON(data);
                $("#frm_idempleado").attr("value", datos["idEmpleado"]);
                $("#frm_rut").attr("value", datos["DocumentoIdentidad"]);
                $("#frm_nombre").attr("value", datos["Nombres"]);
            });
    }

    $(document).ready(function() {
        $.post("./Funciones/generarSelect.php", "t=afp&v=idafp&n=Nombre",
            function(data) {
                $("#empl2_Afp_idAfp").html(data);
            }
        );

        $.post("./Funciones/generarSelect.php", "t=previsionsalud&v=idprevision&n=Nombre",
            function(data) {
                $("#empl2_PrevisionSalud_idPrevision").html(data);
            }
        );

        $.post("./Funciones/generarSelect.php", "t=departamento&v=idDepartamento&n=Nombre",
            function(data) {
                $("#empl2_Departamento_idDepartamento").html(data);
            }
        );

        $.post("./Funciones/generarSelect.php", "t=centrocosto&v=idcentrocosto&n=Nombre",
            function(data) {
                $("#empl2_CentroCosto_idCentroCosto").html(data);
            }
        );
    });
</script>
<h2>Datos de emplado 2</h2>
<hr>
<form name="f_datosemp">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Datos de empleado</th>
        </tr>
        <tr>
            <td><label for="empl2_idEmpleado">idEmpleado</label><br><label for="empl2_rutEmpleado">Rut empleado</label><br><label for="empl2_nombreEmpleado">Nombre empleado</label></td>
            <td><span class="val_"><input type="text" id="empl2_idEmpleado" /><input type="button" value="Buscar" onclick="buscar()"><br><input type="text" id="empl2_rutEmpleado"><input type="button" value="Buscar" onclick="buscarr()"><br><input type="text" id="empl2_nombreEmpleado"></span></td>
        </tr>
        <tr>
            <td><label for="empl2_Contrato_idContrato">Contrato_idContrato</label></td>
            <td><span class="val_"><input type="text" id="empl2_Contrato_idContrato" /></span></td>
        </tr>
        <tr>
            <td><label for="empl2_Afp_idAfp">Afp_idAfp</label></td>
            <td><span class="val_"><select id="empl2_Afp_idAfp"></select></span></td>
        </tr>
        <tr>
            <td><label for="empl2_PrevisionSalud_idPrevision">PrevisionSalud_idPrevision</label></td>
            <td><span class="val_"><select id="empl2_PrevisionSalud_idPrevision"></select></span></td>
        </tr>
        <tr>
            <td><label for="empl2_PrevisionPorcentage">PrevisionPorcentage</label></td>
            <td><span class="val_"><input type="text" id="empl2_PrevisionPorcentage" /></span></td>
        </tr>
        <tr>
            <td><label for="empl2_Departamento_idDepartamento">Departamento_idDepartamento</label></td>
            <td><span class="val_"><select id="empl2_Departamento_idDepartamento"></select></span></td>
        </tr>
        <tr>
            <td><label for="empl2_CentroCosto_idCentroCosto">CentroCosto_idCentroCosto</label></td>
            <td><span class="val_"><select id="empl2_CentroCosto_idCentroCosto"></select></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <table align="center">
                    <tr align="center">
                        <td><input type="button" class="btn" id="btn_ingresar" value="Ingresar" onclick="enviar(new select_empl2(('insert')))" /></td>
                        <td><input type="button" class="btn" id="btn_modificar" value="Modificar" onclick="enviar(new select_empl2(('update')))" /></td>
                        <td><input type="button" class="btn" id="btn_eliminar" value="Eliminar" onclick="enviar(new select_empl2(('delete')))" /></td>
                        <td><input type="button" class="btn" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(), 'panel')" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<hr>
<?php

$tg_sql = "SELECT empleado2.idempleado as id,
  afp.Nombre as afp,
  previsionsalud.nombre as prevision,
  centrocosto.nombre as centrocosto,
  departamento.nombre as departamento
  FROM empleado2, afp, centrocosto, previsionsalud , departamento
  WHERE departamento.iddepartamento = empleado2.departamento_iddepartamento
  and centrocosto.idcentrocosto = empleado2.centrocosto_idcentrocosto
  and previsionsalud.idprevision= empleado2.PrevisionSalud_idPrevision
  and afp.idafp = empleado2.afp_idafp";

$tg_id = "id";
$tg_accion = "<a href=\"#\" onclick=\"cargarDatos(\$id)\"><img src=\"../imagen/tema/ico_aceptar1.png\" width=\"16\" height=\"16\" /></a> <a href=\"#\" onclick=\"eliminarDatos('_t=datosempleado&_pk=idEmpleado&-idEmpleado=\$id')\"><img src=\"../imagen/tema/ico_aceptar0.png\" width=\"16\" height=\"16\" /></a>";
include './Funciones/generarTablaXSql.php';
