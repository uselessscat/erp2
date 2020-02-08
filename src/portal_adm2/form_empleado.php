<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');
if (!isset($_SESSION["aid"]) || $_SESSION["admlv"] > 3) {
    require_once './Funciones/sinpermisos.php';
}
require_once './Funciones/conexion_mysql.php';
?>
<script type="text/javascript" src="./Javascript/calendario.js"></script>
<script type="text/javascript">
    function getDir() {
        return "form_empleado.php";
    }

    function cdato(id) {
        $.post("form_empleado_qry.php", "funcion=cargar&id=" + id, function(data) {
            var datos = $.parseJSON(data);
            $('#id_emp').attr('value', datos['idEmpleado']);
            $('#frm_rut').attr('value', datos['DocumentoIdentidad']);
            $('#frm_nombres').attr('value', datos['Nombres']);
            $('#frm_ap_paterno').attr('value', datos['ApellidoPaterno']);
            $('#frm_ap_materno').attr('value', datos['ApellidoMaterno']);
            $('#frm_fnac').attr('value', datos['Fechanac']);
            $('#frm_direccion').attr('value', datos['Direccion']);
            $('#frm_movil').attr('value', datos['TelefonoMovil']);
            $('#frm_fijo').attr('value', datos['TelefonoFijo']);
            $('#frm_email').attr('value', datos['Email']);
            $('#frm_ocontacto').attr('value', datos['OtroContacto']);
            $('#frm_usuario').attr('value', datos['Login']);

            // forma de seleccionar con jquery
            $('#frm_nacionalidad > option[value=' + datos['Pais_idPais'] + ']').attr('selected', true);
            $('#frm_sexo > option[value=' + datos['Sexo'] + ']').attr('selected', true);
            $('#frm_estado > option[value=' + datos['Estado'] + ']').attr('selected', true);
            $('#frm_nvadm > option[value=' + datos['NivelAdministrativo'] + ']').attr('selected', true);
            $('#frm_civil > option[value=' + datos['EstadoCivil'] + ']').attr('selected', true);
            $('#frm_imagen').attr('src', (datos['Fotografia'] == "") ? "../imagen/tema/default_user.png" : "../imagen/usuario/" + datos['Fotografia']);
        });
    }

    function capturarParametros() {
        var datos = new FormData();
        datos.append("idEmpleado", $("#id_emp").val());
        datos.append("DocumentoIdentidad", $("#frm_rut").val());
        datos.append("Nombres", $("#frm_nombres").val());
        datos.append("ApellidoPaterno", $("#frm_ap_paterno").val());
        datos.append("ApellidoMaterno", $("#frm_ap_materno").val());
        datos.append("FechaNacimiento", $("#frm_fnac").val());
        datos.append("Direccion", $("#frm_direccion").val());
        datos.append("TelefonoMovil", $("#frm_movil").val());
        datos.append("TelefonoFijo", $("#frm_fijo").val());
        datos.append("Email", $("#frm_email").val());
        datos.append("OtroContacto", $("#frm_ocontacto").val());
        datos.append("Login", $("#frm_usuario").val());
        datos.append("Contrasena", $("#frm_clave").val());
        datos.append("Sexo", $("#frm_sexo").val());
        datos.append("EstadoCivil", $("#frm_civil").val());
        datos.append("Pais_idPais", $("#frm_nacionalidad").val());
        datos.append("Ciudad_idCiudad", $("#frm_ciudad").val());
        datos.append("Fotografia", document.getElementById("frm_archivo").files[0]);
        datos.append("Estado", $("#frm_estado").val());
        datos.append("NivelAdministrativo", $("#frm_nvadm").val());

        return datos;
    }

    function ingresarDatos() {
        if ($("#frm_rut").val() == "") {
            alert("debe ingresar un rut");
            return;
        }


        var dt = capturarParametros();
        dt.append("funcion", "ingresar");
        $.ajax({
            type: "POST",
            contentType: false,
            url: "form_empleado_qry.php",
            data: dt,
            processData: false,
            cache: false
        }).done(function(msg) {
            alert(msg);
        });

        /*var params = "funcion=ingresar&" + capturarParametros();
         $.post("form_empleado_qry.php", params, function (data) {
         // mostrar mensaje de error o ingreso
         alert(data);
         });*/
    }

    function modificarDatos() {
        var dt = capturarParametros();
        dt.append("funcion", "modificar");
        $.ajax({
            type: "POST",
            contentType: false,
            url: "form_empleado_qry.php",
            data: dt,
            processData: false,
            cache: false
        }).done(function(msg) {
            alert(msg);
        });

    }

    $(document).ready(function() { // cambia combo boxs
        // arreglar esto
        $.post("./Funciones/generarSelect.php", "t=Pais&v=idPais&n=Nombre",
            function(data) {
                $("#frm_nacionalidad").html(data);
            }
        );

        $.post("./Funciones/generarSelect.php", "t=region&v=idRegion&n=Nombre",
            function(data) {
                $("#frm_region").html(data);
            }
        );

        $("#frm_region").change(function() {
            $.post("./Funciones/generarSelect.php", "t=ciudad&v=idCiudad&n=Nombre&r=Region_idRegion&rv=" + $(this).val(),
                function(data) {
                    $("#frm_ciudad").html(data);
                }
            );
        });

        //    $("#btn_modificar").hide();
        //    $("#btn_eliminar").hide();

        //validador_Rut($('#frm_rut'));
        // validador_Email($('#frm_email'));
    });
</script>
<h2>Empleados</h2>
<hr>
<form id="f_empleado" method="post" action="" enctype="multipart/form-data">
    <table class="tablaformulario">
        <tr>
            <th colspan="4" scope="col">Datos del Empleado</th>
        </tr>
        <tr>
            <td><label for="frm_rut">Rut(Sin Digito Verificador)</label></td>
            <td><input name="frm_rut" id="frm_rut" type="text" maxlength="12" /></td>
            <td colspan="2" rowspan="7">
                <center>
                    <img id="frm_imagen" src="../imagen/tema/default_user.png" width="200" height="200" />
                </center>
            </td>
        </tr>
        <tr>
            <td><label for="frm_nombres">Nombres</label></td>
            <td><input type="text" id="frm_nombres" maxlength="45" /></td>
        </tr>
        <tr>
            <td><label for="frm_ap_paterno">Apellido Paterno</label></td>
            <td><input type="text" id="frm_ap_paterno" maxlength="45" /></td>
        </tr>
        <tr>
            <td><label for="frm_ap_materno">Apellido Materno</label></td>
            <td><input type="text" id="frm_ap_materno" maxlength="45" /></td>
        </tr>
        <tr>
            <td><label for="frm_sexo">Sexo</label></td>
            <td><select name="frm_sexo" id="frm_sexo">
                    <option value="-1">Seleccionar</option>
                    <option value="0" selected="selected">Masculino</option>
                    <option value="1">Femenino</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="frm_fnac">Fecha Nacimiento</label></td>
            <td><input type="text" id="frm_fnac" class="datepicker" size="12" readonly /></td>
        </tr>
        <tr>
            <td><label for="frm_civil">Estado civil</label></td>
            <td><select id="frm_civil">
                    <option value="-1" selected="selected">Seleccione</option>
                    <option value="0">Soltero</option>
                    <option value="1">Casado</option>
                    <option value="2">Viudo</option>
                    <option value="3"> Separado</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="frm_archivo">Fotografia</label></td>
            <td colspan="3"><input name="frm_archivo" type="file" id="frm_archivo" class="ingreso_archivo" /></td>
        </tr>
        <tr>
            <td class="tabla_separador" colspan="4"></td>
        </tr>
        <tr>
            <th colspan="4">Direccion</th>
        </tr>
        <tr>
            <td><label for="frm_nacionalidad">Nacionalidad</label></td>
            <td><select id="frm_nacionalidad">
                    <option value="-1" selected="selected">Seleccione</option>
                </select></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td><label for="frm_region">Region</label></td>
            <td><select name="frm_region" id="frm_region">
                    <option value="-1">Seleccione</option>
                </select></td>
            <td>Ciudad</td>
            <td><select name="frm_ciudad" id="frm_ciudad">
                    <option value="-1">Seleccione</option>
                </select></td>
        </tr>
        <tr>
            <td><label for="frm_direccion">Dirección</label></td>
            <td colspan="3"><input type="text" required id="frm_direccion" size="40" maxlength="60" /></td>
        </tr>
        <tr>
            <td colspan="4" class="tabla_separador"></td>
        </tr>
        <tr>
            <th colspan="4">Contacto</th>
        </tr>
        <tr>
            <td><label for="frm_movil">Telefono Movil</label></td>
            <td><input type="text" id="frm_movil" maxlength="20" /></td>
            <td><label for="frm_fijo">Telefono Fijo</label></td>
            <td><input type="text" id="frm_fijo" maxlength="20" /></td>
        </tr>
        <tr>
            <td><label for="frm_email">Email</label></td>
            <td><input type="text" id="frm_email" maxlength="60" /></td>
            <td><label for="frm_ocontacto">Otro (Especificar en 100 caracteres)</label></td>
            <td><input type="text" id="frm_ocontacto" maxlength="60" /></td>
        </tr>
        <tr>
            <td colspan="4" class="tabla_separador"></td>
        </tr>
        <tr>
            <th colspan="4">Datos de Trabajador</th>
        </tr>
        <tr>
            <td><label for="frm_usuario">Usuario</label></td>
            <td><input name="frm_usuario" type="text" id="frm_usuario" maxlength="45" /></td>
            <td><label for="frm_clave">Contraseña</label></td>
            <td><input type="password" id="frm_clave" maxlength="32"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>Repetir Constraseña</td>
            <td><input type="password" id="frm_clave2" maxlength="32" /></td>
        </tr>
        <tr>
            <td width="25%"><label for="frm_estado">Estado</label></td>
            <td width="25%"><select id="frm_estado">
                    <option value="0">Inactivo</option>
                    <option value="1" selected="selected">Activo</option>
                </select></td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" class="tabla_separador"></td>
        </tr>
        <tr>
            <td width="25%"><label for="frm_nvadm">Nivel Administrativo</label></td>
            <td width="25%"><select id="frm_nvadm">
                    <option value="0">Administrador</option>
                    <option value="1">Jefazo</option>
                    <option value="2">Usuario con permisos</option>
                    <option value="3" selected="selected">Trabajador(Sin permisos administrativos)</option>
                </select></td>
            <td width="25%">&nbsp;</td>
            <td width="25%">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="4" class="tabla_separador"></td>
        </tr>
        <tr>
            <td align="center" colspan="4">
                <table>
                    <tr>
                        <td><input type="button" name="btn_ingresar" id="btn_ingresar" value="Ingresar" onclick="ingresarDatos()" /></td>
                        <td><input type="button" name="btn_modificar" id="btn_modificar" value="Modificar" onclick="modificarDatos()" /></td>
                        <td><input type="button" name="btn_eliminar" id="btn_eliminar" value="Eliminar" onclick="eliminarDatos('_t=empleado&_pk=idEmpleado&-idEmpleado=' + $('#id_emp').val());" /></td>
                        <td><input type="button" name="btn_cancelar" id="btn_cancelar" value="Cancelar" onclick="cargar(getDir(), 'panel')" /></td>
                    </tr>
                </table>
                <input type="hidden" name="id_emp" id="id_emp" />
            </td>
        </tr>
    </table>
</form>
<hr>
<?php
$sql_emp = "select * from empleado;";
$resul_emp = mysqli_query($conexion, $sql_emp);

$total = mysqli_num_rows($resul_emp);
?>
<div id="tg_tabla">
    <a href="javascript:imprimirTabla()">
        <img src="../imagen/tema/printer.png" width="16" height="16" /></a>
    <a href="../portal_trabajador/php/pdf_emp"> <img src="../imagen/tema/document_pdf.png" width="16" height="16" /></a>
    <a href="../portal_trabajador/php/excelEmp.php">
        <img src="../imagen/tema/document_excel.png" width="16" height="16" />
    </a>
    <table>
        <tr>
            <th>Foto</th>
            <th>ID Empleado</th>
            <th>Rut</th>
            <th>Nombres</th>
            <th>Email</th>
            <th>Sexo</th>
            <th>Telefono Movil</th>
            <th>Usuario</th>
            <th>Acción</th>
        </tr>
        <?php
        while ($datos_emp = mysqli_fetch_array($resul_emp)) {
        ?>
            <tr>
                <td height="76"><img id="frm_imagen2" src="<?= ($datos_emp['Fotografia'] == "") ? "../imagen/tema/default_user.png" : "../imagen/usuario/" . $datos_emp['Fotografia'] ?>" width="83" height="72" /></td>
                <td><?php echo $datos_emp['idEmpleado']; ?></td>
                <td><?php echo $datos_emp['DocumentoIdentidad']; ?></td>
                <td><?php echo $datos_emp['Nombres'] . " " . $datos_emp['ApellidoPaterno'] . " " . $datos_emp['ApellidoMaterno']; ?></td>
                <td><?php echo $datos_emp['Email']; ?></td>
                <td><?php echo ($datos_emp['Sexo'] == 1) ? "Femenino" : "Masculino" ?>
                <td><?php echo $datos_emp['TelefonoMovil']; ?></td>
                <td><?php echo $datos_emp['Login']; ?></td>
                <td>
                    <a href="#" onclick="cdato(<?= $datos_emp['idEmpleado'] ?>)"><img src="../imagen/tema/ico_aceptar1.png" width="16" height="16" /></a> <a href="#" onclick="eliminarDatos('_t=empleado&_pk=idEmpleado&-idEmpleado=<?= $datos_emp['idEmpleado'] ?>')"><img src="../imagen/tema/ico_aceptar0.png" width="16" height="16" /></a>
                    <img src="../imagen/tema/ico_bueno<?= $datos_emp['Estado'] ?>.png" width="16" height="16" />
                </td>
            </tr>
        <?php
        }
        ?>
    </table>

</div>