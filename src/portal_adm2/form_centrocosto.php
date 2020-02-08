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
                $sql = sprintf("INSERT INTO centrocosto (idCentroCosto, Nombre, CentroCostoPadre, Fecha) VALUES (%s, '%s', %s, %s);", ($datos->idCentroCosto == "") ? "NULL" : $datos->idCentroCosto, $datos->Nombre, ($datos->CentroCostoPadre == "") ? "NULL" : $datos->CentroCostoPadre, "STR_TO_DATE('" . $datos->Fecha . "','%d-%m-%Y')");
                echo $sql;
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Ingresado correctamente";
            }
            break;

        case "update": {
                $sql = sprintf("UPDATE centrocosto SET Nombre='%s', CentroCostoPadre=%s, Fecha=%s WHERE idCentroCosto=%s", $datos->Nombre, ($datos->CentroCostoPadre == "") ? "NULL" : $datos->CentroCostoPadre, "STR_TO_DATE('" . $datos->Fecha . "','%d-%m-%Y')", $datos->idCentroCosto);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Modificado correctamente";
            }
            break;

        case "delete": {
                $sql = sprintf("DELETE FROM centrocosto WHERE idCentroCosto=%s", $datos->idCentroCosto);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Eliminado correctamente";
            }
            break;

        case "select": {
                $sql = "SELECT *,DATE_FORMAT(Fecha,'%d-%m-%Y') as Fechaf FROM centrocosto c WHERE c.idCentroCosto =  " . $datos->idCentroCosto;
                $result = mysqli_query($conexion, $sql);

                echo json_encode(mysqli_fetch_array($result));
                exit;
            }
            break;
    }
    exit;
}
?>
<script type="text/javascript" src="./Javascript/calendario.js"></script>
<script type="text/javascript">
    function getDir() {
        return "form_centrocosto.php";
    }

    function cargarDatos(id) {
        $.post("./Funciones/qry_TablaCondicionSimple.php", "t=centrocosto&a=DATE_FORMAT(Fecha,'%d-%m-%Y') as Fechaf&n=idCentroCosto&v=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#ccto_idCentroCosto").attr("value", datos["idCentroCosto"]);
                $("#ccto_Nombre").attr("value", datos["Nombre"]);
                $("#ccto_CentroCostoPadre").attr("value", datos["CentroCostoPadre"]);
                $("#ccto_Fecha").attr("value", datos["Fechaf"]);
            }
        );
    }
</script>
<h2>Centros de costos</h2>
<hr>
<form name="f_centro">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Centro de Costos Departamentos</th>
        </tr>
        <tr>
            <td><label for="ccto_idCentroCosto">ID Centro de costo</label></td>
            <td><span class="val_requerido"><input type="text" id="ccto_idCentroCosto"></span></td>
        </tr>
        <tr>
            <td><label for="ccto_Nombre">Nombre centro de costo</label></td>
            <td><span class="val_requerido"><input type="text" id="ccto_Nombre"></span></td>
        </tr>
        <tr>
            <td><label for="ccto_CentroCostoPadre">CentroCostoPadre</label></td>
            <td><span class="val_requerido"><input type="text" id="ccto_CentroCostoPadre"></span></td>
        </tr>
        <tr>
            <td><label for="ccto_Fecha">Fecha</label></td>
            <td><span class="val_requerido"><input type="text" class="datepicker" id="ccto_Fecha" readonly /></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <table align="center">
                    <tr align="center">
                        <td><input type="button" id="btn_ingresar" value="Ingresar" onclick="enviar(new select_ccto('insert'))" /></td>
                        <td><input type="button" id="btn_modificar" value="Modificar" onclick="enviar(new select_ccto('update'))" /></td>
                        <td><input type="button" id="btn_eliminar" value="Eliminar" onclick="enviar(new select_ccto('delete'))" /></td>
                        <td><input type="button" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(), 'panel')" /></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>
<hr>
<?php

$tg_sql = "select c.idCentroCosto as 'ID Centro Costo',"
    . "c.Nombre as 'Nombre Centro Costo',"
    . "(select ce.nombre from centrocosto ce where c.centrocostopadre = ce.idcentrocosto) as 'Centro Costo Padre',"
    . "DATE_FORMAT(c.Fecha,'%d-%m-%Y') as Fecha from centrocosto c;";
$tg_id = "ID Centro Costo";
$tg_accion = "<a href=\"#\" onclick=\"cargarDatos(\$id)\"><img src=\"../imagen/tema/ico_aceptar1.png\" width=\"16\" height=\"16\" /></a> <a href=\"#\" onclick=\"eliminarDatos('_t=centrocosto&_pk=idcentrocosto&-idcentrocosto=\$id')\"><img src=\"../imagen/tema/ico_aceptar0.png\" width=\"16\" height=\"16\" /></a>";
include './Funciones/generarTablaXSql.php';
?>