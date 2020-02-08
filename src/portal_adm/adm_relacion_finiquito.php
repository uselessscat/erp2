<?php
// iniciar sesion y comprobar que esta registrado
session_start();
if (!isset($_SESSION['aid'])) {
    header('Location: index.php');
    exit;
}

//conectar con la base datos
require_once "../php/conexion_mysql.php";
$conexion = ctar_nvl_0();
?>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
<script type="text/javascript" src="../javascript/calendario.js"></script>
<script type="text/javascript">
    function cargarDatos(id, todo) {
        if (todo == true) {
            $.post("adm_relacion_finiquito_qry.php", "funcion=cargar&idEmpleado=" + id, function(data) {
                var datos1 = $.parseJSON(data);
                $('#frm_C_FechaInicioContrato').attr('value', datos1['Fecha']);
                $('#frm_FechaTerminoContrato').attr('value', datos1['fechaTerminoCont']);
                $('#frm_FechaPagoFiniquito').attr('value', datos1['fechaPagoFiniquito']);
                $('#frm_C_Sueldo').attr('value', datos1['Sueldo']);
                $('#frm_Finiquito').attr('value', datos1['Finiquito']);
            });
        }

        $.post("util_consultaTablaSimple.php", "t=empleado&n=" + ((todo == true) ? "idEmpleado" : "DocumentoIdentidad") + "&v=" + id, function(data) {
            var datos2 = $.parseJSON(data);
            $('#frm_idEmpleado').attr('value', datos2['idEmpleado']);
            $('#frm_DocumentoIdentidad').attr('value', datos2['DocumentoIdentidad']);
            $('#frm_Nombres').attr('value', datos2['Nombres']);
            $('#frm_ApellidoPaterno').attr('value', datos2['ApellidoPaterno']);
            $('#frm_ApellidoMaterno').attr('value', datos2['ApellidoMaterno']);
            $('#frm_FechaNacimiento').attr('value', datos2['FechaNacimiento']);
            $('#frm_Direccion').attr('value', datos2['Direccion']);
            $('#frm_Pais_idPais').attr('value', datos2['Pais_idPais']);
            $('#frm_Ciudad_idCiudad').attr('value', datos2['Ciudad_idCiudad']);
        });

        $("#btn_modificar").show();
        $("#btn_eliminar").show();
    }

    function eliminarDatos(id) {
        $.post("adm_relacion_finiquito_qry.php", "funcion=eliminar&idEmpleado=" + id, function(data) {
            alert(data);
        });
    }

    function cancelar() {
        window.location.href = "index.php?pg=adm_relacion_finiquito";
    }

    function capturarParametros() {
        return "Contrato=" + $('#frm_idEmpleado').val() +
            "&FechaTerminoContrato=" + $('#frm_FechaTerminoContrato').val() +
            "&FechaPagoFiniquito=" + $('#frm_FechaPagoFiniquito').val() +
            "&C_Sueldo=" + $('#frm_C_Sueldo').val() +
            "&Finiquito=" + $('#frm_Finiquito').val();
    }

    function ingresarDatos() {
        var params = "funcion=ingresar&" + capturarParametros();
        $.post("adm_relacion_finiquito_qry.php", params, function(data) {
            // mostrar mensaje de error o ingreso
            alert(data);
        });
    }

    function modificarDatos() {
        var params = "funcion=modificar&" + capturarParametros();
        $.post("adm_relacion_finiquito_qry.php", params, function(data) {
            alert(data);
        });
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
        var start = $("#frm_C_FechaInicioContrato").datepicker('getDate');
        var end = $("#frm_FechaTerminoContrato").datepicker('getDate');
        var sueldo = document.getElementById("frm_C_Sueldo").value;
        var tipo = document.getElementById("frm_tipo").value;
        var fechapago = $("#frm_FechaPagoFiniquito").datepicker('getDate');

        var finiquito = "";
        if (!start || !end)
            return;
        var days = 0;
        if (start && end) {
            days = Math.floor(end.getTime() - start.getTime() / 86400000);
            finiquito = Math.floor(sueldo / 30 * days * tipo);
        }
        $("#frm_Finiquito").val(finiquito);

        alert(finiquito);



    }
</script>


<table border="1" cellspacing="1">
    <tr>
        <td colspan="2">
            <div align="center">Datos del trabajador</div>
        </td>
    </tr>
    <tr>
        <td><label for="frm_DocumentoIdentidad">Rut</label></td>
        <td><input type="text" id="frm_DocumentoIdentidad" />
            <input type="button" id="button" value="Buscar" onclick="cargarDatos($('#frm_DocumentoIdentidad').val(), false)" />
            <input type="hidden" id="frm_idEmpleado" /></td>
    </tr>
    <tr>
        <td><label for="frm_Nombres">Nombres</label></td>
        <td><input type="text" id="frm_Nombres" /></td>
    </tr>
    <tr>
        <td><label for="frm_ApellidoPaterno">ApellidoPaterno</label></td>
        <td><input type="text" id="frm_ApellidoPaterno" /></td>
    </tr>
    <tr>
        <td><label for="frm_ApellidoMaterno">ApellidoMaterno</label></td>
        <td><input type="text" id="frm_ApellidoMaterno" /></td>
    </tr>
    <tr>
        <td><label for="frm_FechaNacimiento">FechaNacimiento</label></td>
        <td><input type="text" id="frm_FechaNacimiento" /></td>
    </tr>
    <tr>
        <td><label for="frm_Direccion">Direccion</label></td>
        <td><input type="text" id="frm_Direccion" /></td>
    </tr>
    <tr>
        <td><label for="frm_Pais_idPais">Pais</label></td>
        <td><input type="text" id="frm_Pais_idPais" /></td>
    </tr>
    <tr>
        <td><label for="frm_Ciudad_idCiudad">Ciudad</label></td>
        <td><input type="text" id="frm_Ciudad_idCiudad" /></td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">Datos del finiquito</div>
        </td>
    </tr>
    <tr>
        <td><label for="frm_C_FechaInicioContrato">Fecha Inicio Contrato</label></td>
        <td><input type="text" name="frm_C_FechaInicioContrato" class="datepicker" id="frm_C_FechaInicioContrato" /></td>
    </tr>
    <tr>
        <td><label for="frm_FechaTerminoContrato">Fecha Termino Contrato</label></td>
        <td><input type="text" name="frm_FechaTerminoContrato" class="datepicker" id="frm_FechaTerminoContrato" /></td>
    </tr>
    <tr>
        <td><label for="frm_FechaPagoFiniquito">Fecha Pago Finiquito</label></td>
        <td><input type="text" class="datepicker" id="frm_FechaPagoFiniquito" />
    </tr>
    <tr>
        <td><label for="frm_C_Sueldo">Sueldo</label></td>
        <td><input type="text" id="frm_C_Sueldo" /></td>
    </tr>
    <tr>
        <td>Tipo de despido</td>
        <td><label for="frm_tipo"></label>
            <select name="frm_tipo" id="frm_tipo">
                <option value="45">Despido improcedente</option>
                <option value="33 ">Despido objetivo improcedente</option>
                <option value="20">Despido objetivo</option>
            </select></td>
    </tr>
    <tr>
        <td><label for="frm_Finiquito">Finiquito</label></td>
        <td><input type="text" disabled="disabled" id="frm_Finiquito" readonly="readonly" />
            <input type="button" value="Calcular" onclick="diferenciaFecha()" /></td>
    </tr>
    <tr>
        <td>
        <td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">
                <table border="0" cellspacing="1">
                    <tr>
                        <td>
                            <div align="center">
                                <input type="button" name="frm_ingresar" id="frm_ingresar" value="Ingresar" onclick="ingresarDatos()" />
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="button" name="frm_modificar" id="frm_modificar" value="Modificar" />
                            </div>
                        </td>
                        <td align="center">
                            <div align="center">
                                <input type="button" name="frm_eliminar" id="frm_eliminar" value="Eliminar" />
                            </div>
                        </td>
                        <td>
                            <div align="center">
                                <input type="button" name="btn_cancelar" id="btn_cancelar" value="Cancelar" onclick="cancelar()" />
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
    </tr>
</table>
<?php
$sql_fin = "select *,Contrato, DATE_FORMAT(FechaTerminoContrato,'%d-%m-%Y') as fechaTerminoCont,DATE_FORMAT(FechaPagoFiniquito,'%d-%m-%Y') as fechaPagoFiniquito from finiquito;";
$resul_fin = mysql_query($sql_fin);

$total = mysqli_num_rows($resul_fin);
?>
<div id="grilla"> <a href="javascript:imprimirSelec('grilla')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a><a href="../php/excl_finiquito.php"> <img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
    <table border="1">
        <tr class="font_titulos_grilla">
            <th>IdContrato</th>
            <th>Fecha Termino Contrato</th>
            <th>Fecha Pago Finiquito</th>
            <th>Pago Finiquito</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($datos_fin = mysqli_fetch_array($resul_fin)) {
        ?>
            <tr>
                <td><?= $datos_fin['Contrato'] ?></td>
                <td><?= $datos_fin['fechaTerminoCont'] ?></td>
                <td><?= $datos_fin['fechaPagoFiniquito'] ?></td>
                <td><?= $datos_fin['Finiquito'] ?></td>

                <td><a href="#" onclick="cargarDatos(<?= $datos_fin['Contrato'] ?>, true)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onclick="eliminarDatos(<?= $datos_fin['Contrato'] ?>)"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a></td>
            </tr>
        <?php
        }
        ?>
    </table>
</div>