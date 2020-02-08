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
                $sql = sprintf("INSERT INTO contrato (idContrato, idEmpleado, idCiudad, Fecha, Cargo, DiaInicioTrabajo, DiaFinTrabajo, HoraInicio, HoraFin, DescansoInicio, DescansoFin, Sueldo, Finiquito_idFiniquito, TipoContrato) VALUES (%s, %s, %s, '%s', '%s', %s, %s, %s, %s, %s, %s, %s, %s, '%s')", "NULL" /*$datos->idContrato*/, $datos->idEmpleado, $datos->idCiudad, $datos->Fecha, $datos->Cargo, $datos->DiaInicioTrabajo, $datos->DiaFinTrabajo, $datos->HoraInicio, $datos->HoraFin, $datos->DescansoInicio, $datos->DescansoFin, $datos->Sueldo, "NULL" /*  $datos->Finiquito_idFiniquito */, $datos->TipoContrato);
                echo $sql;
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Ingresado correctamente";
            }
            break;

        case "update": {
                $sql = sprintf("UPDATE contrato SET idEmpleado = %s, idCiudad = %s, Fecha = %s, Cargo = %s, DiaInicioTrabajo = %s, DiaFinTrabajo = %s, HoraInicio = %s, HoraFin = %s, DescansoInicio = %s, DescansoFin = %s, Sueldo = %s, Finiquito_idFiniquito = %s, TipoContrato = %s WHERE idContrato = %s", $datos->idEmpleado, $datos->idCiudad, $datos->Fecha, $datos->Cargo, $datos->DiaInicioTrabajo, $datos->DiaFinTrabajo, $datos->HoraInicio, $datos->HoraFin, $datos->DescansoInicio, $datos->DescansoFin, $datos->Sueldo, $datos->Finiquito_idFiniquito, $datos->TipoContrato, $datos->idContrato);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Modificado correctamente";
            }
            break;

        case "delete": {
                $sql = sprintf("DELETE FROM contrato WHERE idcontrato=%s", $datos->idContrato);
                $result = mysqli_query($conexion, $sql);

                $error = mysqli_error($conexion);
                echo ($error != '') ? $error : "Eliminado correctamente";
            }
            break;
    }
    exit;
}
?>
<script type="text/javascript" src="./Javascript/calendario.js"></script>
<script>
    function imprimirContrato(id) {
        var ventimp = window.open('../portal_trabajador/php/pdf_contrato.php?id=' + id, 'popimpr');
        ventimp.print();

    }

    $(document).ready(function() {
        $.post("./Funciones/generarSelect.php", "t=region&v=idRegion&n=Nombre",
            function(data) {
                $("#contrato_region").html(data);
            });

        $("#contrato_region").change(function() {
            $.post("./Funciones/generarSelect.php", "t=ciudad&v=idCiudad&n=Nombre&r=Region_idRegion&rv=" + $(this).val(),
                function(data) {
                    $("#contrato_idCiudad").html(data);
                });
        });

        $.post("./Funciones/generarSelect.php", "t=departamento&v=idDepartamento&n=Nombre",
            function(data) {
                $("#contrato_dpto").html(data);
            });

        $.post("./Funciones/generarSelect.php", "t=afp&v=idafp&n=Nombre",
            function(data) {
                $("#contrato_afp").html(data);
            });
    });
</script>
<script type="text/javascript">
    function getDir() {
        return "form_relacion_contrato.php";
    }

    function buscar(id) {
        $.post("form_relacion_contrato_qry.php", "funcion=buscar&DocumentoIdentidad=" + $("#contrato_rut").val(),
            function(data) {
                var datos = $.parseJSON(data);
                $("#contrato_idEmpleado").attr("value", datos["idEmpleado"]);
                $("#contrato_rut").attr("value", datos["DocumentoIdentidad"]);
                $("#contrato_nombres").attr("value", datos["Nombres"]);
                $("#contrato_ap_paterno").attr("value", datos["ApellidoPaterno"]);
                $("#contrato_ap_materno").attr("value", datos["ApellidoMaterno"]);
                $("#contrato_pais").attr("value", datos["Nombre"]);
                $("#contrato_sexo").attr("value", (datos["Sexo"] == 0) ? "Masculino" : "Femenino");
                $("#contrato_fnac").attr("value", datos["FechaNacimiento"]);
                $("#contrato_civil").attr("value", function() {
                    switch (parseInt(datos["EstadoCivil"])) {
                        case 0:
                            return "Soltero";
                            break;
                        case 1:
                            return "Casado";
                            break;
                        case 2:
                            return "Viudo";
                            break;
                        case 3:
                            return "Separado";
                            break;
                        default:
                            alert(datos["EstadoCivil"]);
                    }
                });
            });
    }

    function cargarDatos(id) {
        $.post("form_relacion_contrato_qry.php", "funcion=cargar&idempleado=" + id,
            function(data) {
                var datos = $.parseJSON(data);
                $("#contrato_idEmpleado").attr("value", datos["idEmpleado"]);
                $("#contrato_rut").attr("value", datos["DocumentoIdentidad"]);
                $("#contrato_nombres").attr("value", datos["Nombres"]);
                $("#contrato_ap_paterno").attr("value", datos["ApellidoPaterno"]);
                $("#contrato_ap_materno").attr("value", datos["ApellidoMaterno"]);
                $("#contrato_pais").attr("value", datos["Pais_idPais"]);
                $("#contrato_sexo").attr("value", datos["Sexo"]);
                $("#contrato_fnac").attr("value", datos["FechaNacimiento"]);
                $("#contrato_civil").attr("value", datos["EstadoCivil"]);
                $("#contrato_dpto > option[value=" + datos["idDepartamento"] + "]").attr('selected', true);
                $("#contrato_Cargo").attr("value", datos["Cargo"]);
                $("#contrato_region > option[value=" + datos["idRegion"] + "]").attr('selected', true);
                $("#contrato_ciudad > option[value=" + datos["idCiudad"] + "]").attr('selected', true);
                $("#contrato_fecha").attr("value", datos["Fecha"]);
                $("#contrato_DiaInicioTrabajo > option[value=" + datos["DiaInicioTrabajo"] + "]").attr('selected', true);
                $("#contrato_DiaFinTrabajo > option[value=" + datos["DiaFinTrabajo"] + "]").attr('selected', true);
                $("#Contrato_HoraInicio > option[value=" + datos["horainicio"] + "]").attr('selected', true);
                $("#Minicio > option[value=" + datos["minutosinicio"] + "]").attr('selected', true);
                $("#Contrato_HoraFin > option[value=" + datos["horafin"] + "]").attr('selected', true);
                $("#minf > option[value=" + datos["minutosfin"] + "]").attr('selected', true);
                $("#Contrato_DescansoInicio > option[value=" + datos["DescansoInicio"] + "]").attr('selected', true);
                $("#Contrato_DescansoFin > option[value=" + datos["DescansoFin"] + "]").attr('selected', true);
                $("#contrato_Sueldo").attr("value", datos["Sueldo"]);
                $("#contrato_TipoContrato > option[value=" + datos["TipoContrato"] + "]").attr('selected', true);
            }
        );
    }
</script>

<h2>Contrato del Personal</h2>
<hr>
<form name="f_contrato">
    <table class="tablaformulario">
        <tr>
            <th colspan="2">Datos del Trabajador</th>
        </tr>
        <tr>
            <td><label for="contrato_rut">Rut</label></td>
            <td><span>
                    <input name="contrato_rut" type="text" required id="contrato_rut" maxlength="12" />
                </span>
                <input type="hidden" id="contrato_idEmpleado" />
                <input type="button" value="Buscar" onClick="buscar()" /></td>
        </tr>
        <tr>
            <td><label for="contrato_nombres">Nombres</label></td>
            <td><span>
                    <input type="text" disabled="disabled" required id="contrato_nombres" readonly />
                </span></td>
        </tr>
        <tr>
            <td><label for="contrato_ap_paterno">Apellido Paterno</label></td>
            <td><span>
                    <input type="text" disabled="disabled" required id="contrato_ap_paterno" readonly />
                </span></td>
        </tr>
        <tr>
            <td><label for="contrato_ap_materno">Apellido Materno</label></td>
            <td><span>
                    <input type="text" disabled="disabled" required id="contrato_ap_materno" readonly />
                </span></td>
        </tr>
        <tr>
            <td>Nacionalidad</td>
            <td><span>
                    <input name="contrato_pais" type="text" disabled="disabled" required id="contrato_pais" readonly />
                </span></td>
        </tr>
        <tr>
            <td><label for="contrato_sexo">Sexo</label></td>
            <td><span>
                    <input type="text" disabled="disabled" required id="contrato_sexo" readonly />
                </span></td>
        </tr>
        <tr>
            <td><label for="contrato_fnac">Fecha Nacimiento</label></td>
            <td><span>
                    <input type="text" id="contrato_fnac" disabled="disabled" readonly />
                </span></td>
        </tr>
        <tr>
            <td><label for="contrato_civil">Estado civil</label></td>
            <td><span>
                    <input type="text" disabled="disabled" required id="contrato_civil" readonly />
                </span></td>
        </tr>
        <tr>
            <td>Departamento</td>
            <td><label for="contrato_dpto"></label>
                <select name="contrato_dpto" id="contrato_dpto">
                    <option value="-1">Seleccione</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="contrato_Cargo">Cargo</label></td>
            <td><span class="vali"><input type="text" id="contrato_Cargo" /></span></td>
        </tr>
        <tr>
            <th colspan="2">Datos del Contrato</th>
        </tr>
        <tr>
            <td>Region</td>
            <td><label for="contrato_region"></label>
                <select name="contrato_region" id="contrato_region">
                    <option value="-1">Seleccione</option>
                </select></td>
        </tr>
        <tr>
            <td>Ciudad</td>
            <td><select id="contrato_idCiudad">
                    <option value="-1">Seleccione</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="contrato_Fecha">Fecha</label></td>
            <td><span class="val_"><input type="text" id="contrato_Fecha" class="datepicker" size="12" readonly /></span></td>
        </tr>

        <tr>
            <td><label for="contrato_DiaInicioTrabajo">Dia de trabajo</label></td>
            <td>De
                <select name="contrato_DiaInicioTrabajo" id="contrato_DiaInicioTrabajo">
                    <option value="0" selected="selected">Lunes</option>
                    <option value="1">Martes</option>
                    <option value="2">Miercoles</option>
                    <option value="3">Jueves</option>
                    <option value="4">Viernes</option>
                    <option value="5">Sábado</option>
                    <option value="6">Domingo</option>
                </select>
                A
                <select name="contrato_DiaFinTrabajo" id="contrato_DiaFinTrabajo">
                    <option value="1" selected="selected">Lunes</option>
                    <option value="2">Martes</option>
                    <option value="3">Miercoles</option>
                    <option value="4">Jueves</option>
                    <option value="5">Viernes</option>
                    <option value="6">Sábado</option>
                    <option value="7">Domingo</option>
                </select></td>
        </tr>
        <tr>
            <td>Horario de trabajo</td>
            <td><label for="contrato_HoraInicio">Desde las </label>
                <select name="contrato_HoraInicio" required id="contrato_HoraInicio">
                    <?php
                    for ($i = 00; $i <= 23; $i++) {
                    ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                    <?php } ?>
                </select>
                :
                <select name="contrato_Minicio" required id="contrato_Minicio">
                    <?php
                    for ($x = 00; $x <= 59; $x++) {
                    ?>
                        <option value="<?php echo $x ?>"><?php echo $x ?></option>
                    <?php } ?>
                </select>
                <label for="contrato_HoraFin">Hasta</label>
                <select name="contrato_HoraFin" required id="contrato_HoraFin">
                    <?php
                    for ($y = 00; $y <= 23; $y++) {
                    ?>
                        <option value="<?php echo $y ?>"><?php echo $y ?></option>
                    <?php } ?>
                </select>
                :
                <select name="contrato_Mfin" required id="contrato_Mfin">
                    <?php
                    for ($z = 00; $z <= 59; $z++) {
                    ?>
                        <option value="<?php echo $z ?>"><?php echo $z ?></option>
                    <?php } ?>
                </select>
                Hrs </td>
        </tr>
        <tr>
            <td><label for="contrato_DescansoInicio">Dias de descanso</label></td>
            <td>Inicio
                <select name="contrato_DescansoInicio" id="contrato_DescansoInicio">
                    <option value="0" selected="selected">Lunes</option>
                    <option value="1">Martes</option>
                    <option value="2">Miercoles</option>
                    <option value="3">Jueves</option>
                    <option value="4">Viernes</option>
                    <option value="5">Sábado</option>
                    <option value="6">Domingo</option>
                </select>
                Fin
                <select name="contrato_DescansoFin" id="contrato_DescansoFin">
                    <option value="0" selected="selected">Lunes</option>
                    <option value="1">Martes</option>
                    <option value="2">Miercoles</option>
                    <option value="3">Jueves</option>
                    <option value="4">Viernes</option>
                    <option value="5">Sábado</option>
                    <option value="6">Domingo</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="contrato_Sueldo">Sueldo</label></td>
            <td><span class="val_"><input type="text" id="contrato_Sueldo" /></span></td>
        </tr>
        <tr>
            <td>Tipo de contrato</td>
            <td><label for="contrato_TipoContrato">Tipo de Contrato</label>
                <select name="contrato_TipoContrato" id="contrato_TipoContrato">
                    <option value="-1">Seleccione</option>
                    <option value="Honorarios">Honorarios</option>
                    <option value="Indefinido">Indefinido</option>
                </select></td>
        </tr>
        <tr>
            <td colspan="2">
                <div align="center">
                    <input type="button" id="btn_ingresar" value="Ingresar" onClick="enviar(new select_contrato('insert'))" />
                    <input type="button" id="btn_modificar" value="Modificar" onClick="enviar(new select_contrato('update'))" />
                    <input type="button" id="btn_eliminar" value="Eliminar" onClick="enviar(new select_contrato('delete'))" />
                    <input type="button" id="btn_cancelar" value="Cancelar" onClick="cargar(getDir(), 'panel')" />
                </div>
            </td>
        </tr>
    </table>
</form>
<hr>
<a href="../php/pdf_contrato"></a>
<?php
$tg_sql = "SELECT e.idEmpleado AS Id, "
    . "e.DocumentoIdentidad AS 'Rut',"
    . "concat(e.Nombres ,' ', e.ApellidoPaterno , ' ' , e.ApellidoMaterno) AS 'Nombres', "
    . "c.Cargo AS 'Cargo', "
    . "d.Nombre AS 'Departamento', "
    . "c.Sueldo AS 'Sueldo Base', "
    . "c.TipoContrato AS 'Tipo de Contrato' "
    . "FROM empleado e, contrato c, departamento d, empleado2 da "
    . "WHERE da.idEmpleado = c.idEmpleado "
    . "AND da.idEmpleado = e.idEmpleado "
    . "AND da.Departamento_idDepartamento = d.idDepartamento";
$tg_id = "Id";
$tg_accion = "<a href=\"#\" onClick=\"cargarDatos(\$id)\">"
    . "<img src=\"../imagen/tema/ico_aceptar1.png\" width=\"16\" height=\"16\" /></a>"
    . "<a href=\"#\" onClick=\"eliminarDatos(\$id)\"><img src=\"../imagen/tema/cross.png\" width=\"16\" height=\"16\" /></a>"
    . "<a href=\"../portal_trabajador/php/pdf_contrato?id=\$id\"><img src=\"../imagen/tema/document_pdf.png\" width=\"16\" height=\"16\" /></a><a href=\"#\" onclick=\"imprimirContrato(\$id)\"><img src=\"../imagen/tema/printer.png\" width=\"16\" height=\"16\" /></a>";
include './Funciones/generarTablaXSql.php';
?>