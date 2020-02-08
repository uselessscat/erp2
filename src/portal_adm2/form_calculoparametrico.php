<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
?>

<script type="text/javascript">
    //agregar campos a la lista de calculos
    var datosHaber, datosHaberOption = "",
        datosDscto, datosDsctoOption = "";

    function anadirCampo(tipo) {
        var count = $("#" + tipo + " > table tr").length;
        var datosOption = (tipo == "haber") ? datosHaberOption : datosDsctoOption;
        var datos = (tipo == "haber") ? datosHaber : datosDscto;
        $("#" + tipo + " table").append(
            "<tr><td>\nDetalle <select id=\"" + tipo + "_" + count + "\">\n" + datosOption + "</select></td>" +
            "<td>Valor<input type=\"text\" id=\"" + tipo + "_" + count + "_value\" /></td></tr>"
        );

        function cambiar() {
            var val = $("#" + tipo + "_" + count).val();
            $("#" + tipo + "_" + count + "_value").val((datos[val]['valordefecto']) ? datos[val]['valordefecto'] : "0");
        }

        cambiar();

        $("#" + tipo + "_" + count).change(function() {
            cambiar();
        });

    }

    //quitar campos de la lista
    function quitarCampo(tipo) {
        $("#" + tipo + " table tr:last").remove();
    }

    function calcular() {
        var total = 0,
            totalDesc = 0,
            totalHaber = 0;

        var habsel = $("#haber input");
        for (var t = habsel.length, i = 0; i < t; i++) {
            totalHaber += parseInt(habsel.eq(i).val());
        }

        var descsel = $("#desc input");
        for (var t = descsel.length, i = 0; i < t; i++) {
            totalDesc += parseInt(descsel.eq(i).val());
        }

        total = totalHaber - totalDesc;
        $("#resultado").html("<table class='tablaformulario' style=\" text-align: center;\"><tr><th colspan='2'>Resultados</th></tr>" +
            "<tr><td>Total Haberes</td><td>" + totalHaber + "</td></tr>" +
            "<tr><td>Total Descuentos</td><td>" + totalDesc + "</td></tr>" +
            "<tr><td>Total A Pagar</td><td>" + total + "</td></tr></table>"
        );
    }

    // cargar datos solo al cargar la pagina
    $(function() {
        $.post("./Funciones/qry_Tabla.php", "t=haber",
            function(data) {
                datosHaber = $.parseJSON(data);
                for (var i = 0; i < datosHaber.length; i++) {
                    datosHaberOption += "<option value=\"" + i + "\">" + datosHaber[i]['nombre'] + "</option>";
                }
            }
        );
        $.post("./Funciones/qry_Tabla.php", "t=descuento",
            function(data) {
                datosDscto = $.parseJSON(data);
                for (var i = 0; i < datosHaber.length; i++) {
                    datosDsctoOption += "<option value=\"" + i + "\">" + datosDscto[i]['nombre'] + "</option>";
                }
            }
        );
    });

    function limpiar() {
        $('#resultado').html('');
    }
</script>
<h2>Liquidacion de sueldo</h2>
<hr>
<div id="divcfg" style="display: none">
    <table id="tablecfg">
        <tr>
            <th colspan="2">Configuracion (por si acaso)</th>
        </tr>
        <tr>
            <td>Valor de Uf..</td>
            <td><input type="text" /></td>
        </tr>
    </table>
</div>
<div id="divcalculos">
    <form name="f_calculos">
        <table class="tablaformulario" style="text-align: center;">
            <tr>
                <th colspan="2">Empresa</th>
            </tr>
            <tr>
                <td><label for="frm_Razon_empresa">Razon Social</label></td>
                <td><input id="frm_Razon_empresa" type="text" /></td>
            </tr>
            <tr>
                <td><label for="frm_RUT_empresa">RUT</label></td>
                <td><input id="frm_RUT_empresa" type="text" /></td>
            </tr>
            <tr>
                <td><label for="frm_Direccion_empresa">Direccion</label></td>
                <td><input id="frm_Direccion_empresa" type="text" /></td>
            </tr>
            <tr class="tabla_separador">
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2">Trabajador</th>
            </tr>
            <tr>
                <td><label for="frm_Nombre_empleado">Nombre</label></td>
                <td><input id="frm_Nombre_empleado" type="text" /></td>
            </tr>
            <tr>
                <td><label for="frm_RUT_empleado">RUT</label></td>
                <td><input id="frm_RUT_empleado" type="text" /></td>
            </tr>
            <tr>
                <td><label for="frm_Cargo_empleado">Cargo</label></td>
                <td><input id="frm_Cargo_empleado" type="text" /></td>
            </tr>
            <tr class="tabla_separador">
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2"> Haberes </th>
            </tr>
            <tr>
                <td colspan="2"><label>Ingrese los Haberes correspondientes:</label>
                    <div id="haber">
                        <table style="width: 100%">
                        </table>
                    </div>
                    <input type="button" value="+" onclick="anadirCampo('haber')" />
                    <input type="button" value="-" onclick="quitarCampo('haber')" />
                </td>
            </tr>
            <tr class="tabla_separador">
                <td colspan="2"></td>
            </tr>
            <tr>
                <th colspan="2"> Descuentos </th>
            </tr>
            <tr>
                <td colspan="2"><label>Ingrese los Descuentos correspondientes:</label>
                    <div id="desc">
                        <table style="width: 100%">
                        </table>
                    </div>
                    <input type="button" value="+" onclick="anadirCampo('desc')" />
                    <input type="button" value="-" onclick="quitarCampo('desc')" />
                </td>
            </tr>
            <tr class="tabla_separador">
                <td colspan="2"></td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="button" value="Calcular" onclick="calcular()" />
                    <input type="button" value="Limpiar" onclick="limpiar()" />
                </td>
            </tr>
        </table>
    </form>
</div>
<hr>
<div id="resultado">

</div>