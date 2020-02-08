<?php

//conectar con la base datos
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';
?>
<script type="text/javascript" src="./Javascript/calendario.js"></script>
<script type="text/javascript">
    function imprimirFiniquito(id) {
        var ventimp = window.open('../portal_adm/Funciones/generarFiniquito.php?id=' + id, 'popimpr');
        ventimp.print();
    }

    function getDir() {
        return "form_relacion_finiquito.php";
    }

    function cargarDatos(id, todo) {
        if (todo == true) {
            $.post("form_relacion_finiquito_qry.php", "funcion=cargar&idEmpleado=" + id, function(data) {
                var datos1 = $.parseJSON(data);
                $('#finiquito_C_FechaInicioContrato').attr('value', datos1['Fecha']);
                $('#finiquito_FechaTerminoContrato').attr('value', datos1['fechaTerminoCont']);
                $('#finiquito_FechaPagoFiniquito').attr('value', datos1['fechaPagoFiniquito']);
                $('#finiquito_C_Sueldo').attr('value', datos1['Sueldo']);
                $('#finiquito_Finiquito').attr('value', datos1['Finiquito']);
            });
        }

        $.post("./Funciones/qry_TablaCondicionSimple.php", "t=empleado&n=" + ((todo == true) ? "idEmpleado" : "DocumentoIdentidad") + "&v=" + id, function(data) {
            var datos2 = $.parseJSON(data);
            $('#finiquito_idEmpleado').attr('value', datos2['idEmpleado']);
            $('#finiquito_DocumentoIdentidad').attr('value', datos2['DocumentoIdentidad']);
            $('#finiquito_Nombres').attr('value', datos2['Nombres']);
            $('#finiquito_ApellidoPaterno').attr('value', datos2['ApellidoPaterno']);
            $('#finiquito_ApellidoMaterno').attr('value', datos2['ApellidoMaterno']);
            $('#finiquito_FechaNacimiento').attr('value', datos2['FechaNacimiento']);
            $('#finiquito_Direccion').attr('value', datos2['Direccion']);
            $('#finiquito_Pais_idPais').attr('value', datos2['Pais_idPais']);
            $('#finiquito_Ciudad_idCiudad').attr('value', datos2['Ciudad_idCiudad']);
        });

        $("#btn_modificar").show();
        $("#btn_eliminar").show();
    }


    function eliminarDatos(id) {
        $.post("form_relacion_finiquito_qry.php", "funcion=eliminar&idEmpleado=" + id, function(data) {
            alert(data);
        });

        cargar(getDir(), 'panel');
    }

    function capturarParametros() {
        return "Contrato_idContrato=" + $('#finiquito_idEmpleado').val() +
            "&FechaTerminoContrato=" + $('#finiquito_FechaTerminoContrato').val() +
            "&FechaPagoFiniquito=" + $('#finiquito_FechaPagoFiniquito').val() +
            "&C_Sueldo=" + $('#finiquito_C_Sueldo').val() +
            "&Finiquito=" + $('#finiquito_Finiquito').val();
    }

    function ingresarDatos() {
        var params = "funcion=ingresar&" + capturarParametros();
        $.post("form_relacion_finiquito_qry.php", params, function(data) {
            // mostrar mensaje de error o ingreso
            alert(data);
        });

        cargar(getDir(), 'panel');
    }

    function modificarDatos() {
        var params = "funcion=modificar&" + capturarParametros();
        $.post("form_relacion_finiquito_qry.php", params, function(data) {
            alert(data);
        });
        cargar(getDir(), 'panel');
    }
</script>
<script>
    function imprimirSelec(nombre) {
        var ficha = document.getElementById(nombre);
        var ventimp = window.open(' ', 'popimpr');
        ventimp.document.write(ficha.innerHTML);
        ventimp.document.close();
        ventimp.print();
        ventimp.close();
    }
</script>
<script>
    function diferenciaFecha() {
        var start = $("#finiquito_C_FechaInicioContrato").datepicker('getDate');
        var end = $("#finiquito_FechaTerminoContrato").datepicker('getDate');
        var sueldo = document.getElementById("finiquito_C_Sueldo").value;
        var tipo = document.getElementById("finiquito_tipo").value;
        var fechapago = $("#finiquito_FechaPagoFiniquito").datepicker('getDate');

        var finiquito = "";
        if (!start || !end)
            return;
        var days = 0;
        var resta = 0;
        var finiq = 0;
        if (start && end) {
            resta = Math.floor((fechapago.getTime() - end.getTime()) / 86400000);
            days = Math.floor((resta + (end.getTime() - start.getTime()) / 86400000));
            alert(days);
            finiquito = Math.floor((parseInt(sueldo) / 30) * (days / 360) * tipo);
        }
        $("#finiquito_Finiquito").val(finiquito);

        alert(finiquito);
    }
</script>

<h2>Finiquitos</h2>
<hr>
<form name="f_finiquito">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Datos del trabajador</th>
        </tr>
        <tr>
            <td><label for="finiquito_DocumentoIdentidad">Rut</label></td>
            <td><span><input type="text" id="finiquito_DocumentoIdentidad" /></span>
                <input type="button" id="button" value="Buscar" onclick="cargarDatos($('#finiquito_DocumentoIdentidad').val(), false)" />
                <input type="hidden" id="finiquito_idEmpleado" /></td>
        </tr>
        <tr>
            <td><label for="finiquito_Nombres">Nombres</label></td>
            <td><span><input type="text" id="finiquito_Nombres" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_ApellidoPaterno">ApellidoPaterno</label></td>
            <td><span><input type="text" id="finiquito_ApellidoPaterno" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_ApellidoMaterno">ApellidoMaterno</label></td>
            <td><span><input type="text" id="finiquito_ApellidoMaterno" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_FechaNacimiento">FechaNacimiento</label></td>
            <td><span><input type="text" id="finiquito_FechaNacimiento" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_Direccion">Direccion</label></td>
            <td><span><input type="text" id="finiquito_Direccion" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_Pais_idPais">Pais</label></td>
            <td><span><input type="text" id="finiquito_Pais_idPais" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_Ciudad_idCiudad">Ciudad</label></td>
            <td><span><input type="text" id="finiquito_Ciudad_idCiudad" /></span></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">Datos del finiquito</div>
            </td>
        </tr>
        <tr>
            <td><label for="finiquito_Fecha">Fecha Inicio Contrato</label></td>
            <td><span><input type="text" name="finiquito_Fecha" class="datepicker" id="finiquito_Fecha" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_FechaTerminoContrato">Fecha Termino Contrato</label></td>
            <td><span><input type="text" name="finiquito_FechaTerminoContrato" class="datepicker" id="finiquito_FechaTerminoContrato" /></span></td>
        </tr>
        <tr>
            <td><label for="finiquito_FechaPagoFiniquito">Fecha Pago Finiquito</label></td>
            <td><span><input type="text" class="datepicker" id="</span>finiquito_FechaPagoFiniquito" />
        </tr>
        <tr>
            <td><label for="finiquito_Sueldo">Sueldo</label></td>
            <td><span><input type="text" id="finiquito_Sueldo" /></span></td>
        </tr>
        <tr>
            <td>Tipo de despido</td>
            <td><label for="finiquito_tipo"></label>
                <select name="finiquito_tipo" id="finiquito_tipo">
                    <option value="45">Despido improcedente</option>
                    <option value="33 ">Despido objetivo improcedente</option>
                    <option value="20">Despido objetivo</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="finiquito_Total">Finiquito</label></td>
            <td><input type="text" disabled="disabled" id="finiquito_Total" readonly="readonly" />
                <input type="button" value="Calcular" onclick="diferenciaFecha()" /></td>
        </tr>
        <tr>
            <td>
            <td>
        </tr>
        <tr>
            <td colspan="2">
                <table>
                    <tr>
                        <td>
                            <div align="center">
                                <input type="button" name="finiquito_ingresar" id="finiquito_ingresar" value="Ingresar" onclick="ingresarDatos()" />
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="button" name="finiquito_modificar" id="finiquito_modificar" value="Modificar" />
                            </div>
                        </td>
                        <td align="center">
                            <div align="center">
                                <input type="button" name="finiquito_eliminar" id="finiquito_eliminar" value="Eliminar" />
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="button" name="btn_cancelar" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(),'panel')" />
                            </div>
                        </td>
                    </tr>
                </table>
        </tr>
    </table>
</form>
<hr>
<a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a><a href="../php/excl_finiquito.php"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
<?php

$tg_sql = "select IdFiniquito as 'IdFiniquito', DATE_FORMAT(FechaTerminoContrato,'%d-%m-%Y') as fechaTerminoCont,DATE_FORMAT(FechaPagoFiniquito,'%d-%m-%Y') as fechaPagoFiniquito,Total as 'Total Finiquito' from finiquito;";
$tg_accion = "<a href = \"#\" onclick = \"cargarDatos(\$id, true)\"><img src = \"../imagen/tema/ico_aceptar1.png\" width = \"16\" height = \"16\" /></a> <a href = \"#\" onclick = \"eliminarDatos(\$id)\"><img src = \"../imagen/tema/ico_aceptar0.png\" width = \"16\" height = \"16\" /></a><a href=\"#\" onclick=\"imprimirFiniquito(\$id)\"><img src=\"../imagen/tema/printer.png\" width=\"16\" height=\"16\" /></a></td>";
$tg_id = "IdFiniquito";
include './Funciones/generarTablaXSql.php';
?>