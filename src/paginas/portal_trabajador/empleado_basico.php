<?php

function contenido()
{
    require 'php/conexion_mysql.php';

    $conexion = ctar_nvl_2();

    $sql = "SELECT * FROM empleado WHERE idEmpleado = {$_SESSION['uid']};";

    $result = mysqli_query($conexion, $sql);
    mysqli_close($conexion);

    $datos_emp = mysqli_fetch_array($result);

    ?>
    <form id="f_emp_basico" method="POST" action="paginas/portal_trabajador/empleado_basico_qry.php" enctype="multipart/form-data">
        <table class="tablaformulario">
            <tr>
                <th colspan="4" scope="col">Datos del Empleado</th>
            </tr>
            <tr>
                <td><label for="frm_rut">Rut</label></td>
                <td><input type="text" name="frm_rut" value="<?= $datos_emp['DocumentoIdentidad']; ?>" readonly="readonly" /></td>
                <td colspan="2" rowspan="7">
                    <center>
                        <img src="imagen/usuario/<?= ($datos_emp['Fotografia'] == 0) ? "default.png" : $datos_emp['id'] . "png" ?>" width="200" height="200" />
                    </center>
                </td>
            </tr>
            <tr>
                <td><label for="frm_nombres">Nombres</label></td>
                <td><input type="text" name="frm_nombres" value="<?= $datos_emp['Nombres']; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
                <td><label for="frm_ap_paterno">Apellido Paterno</label></td>
                <td><input type="text" name="frm_ap_paterno" value="<?= $datos_emp['ApellidoPaterno']; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
                <td><label for="frm_ap_materno">Apellido Materno</label></td>
                <td><input type="text" name="frm_ap_materno" value="<?= $datos_emp['ApellidoMaterno']; ?>" readonly="readonly" /></td>
            </tr>
            <tr>
                <td><label for="frm_sexo">Sexo</label></td>
                <td>
                    <select name="frm_sexo" name="frm_sexo">
                        <option value="-1" selected="selected">
                            <?php
                            switch ($datos_emp['Sexo']) {
                                case 0: {
                                        echo 'Masculino';
                                        break;
                                    }
                                case 1: {
                                        echo 'Femenino';
                                        break;
                                    }
                                default:
                                    echo 'Error: valor fuera del rango';
                            }
                            ?>
                        </option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="frm_fnac">Fecha Nacimiento</label></td>
                <td><input type="text" name="frm_fnac" readonly="readonly" value="<?= $datos_emp['FechaNacimiento'] ?>" /></td>
            </tr>
            <tr>
                <td><label for="frm_civil">Estado civil</label></td>
                <td>
                    <select name="frm_civil">
                        <?php
                        $estados = [
                            '-1' => 'Seleccione',
                            '0' => 'Soltero',
                            '1' => 'Casado',
                            '2' => 'Viudo',
                            '3' => 'Separado',
                        ];

                        foreach ($estados as $key => $value) {
                            if ($datos_emp['EstadoCivil'] == $key) {
                                echo "<option value=\"$key\" selected=\"selected\">$value</option>";
                            } else {
                                echo "<option value=\"$key\">$value</option>";
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="frm_archivo">Fotografia</label></td>
                <td colspan="3"><input type="file" name="frm_archivo" /></td>
            </tr>
            <tr>
                <td class="tabla_separador"></td>
            </tr>
            <tr>
                <th colspan="4">Direccion</th>
            </tr>
            <tr>
                <td><label for="frm_nacionalidad">Nacionalidad</label></td>
                <td>
                    <select name="frm_nacionalidad">
                        <option value="-1" selected="selected">Seleccione</option>
                    </select>
                </td>
                <td><label for="frm_region">Region</label></td>
                <td>
                    <select name="frm_region">
                        <option value="-1">Seleccione</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="frm_ciudad">Ciudad</label></td>
                <td>
                    <select name="frm_ciudad">
                        <option value="-1">Seleccione</option>
                    </select>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><label for="frm_direccion">Dirección</label></td>
                <td colspan="3">
                    <input width="100%" required type="text" name="frm_direccion" value="<?= $datos_emp['Direccion']; ?>" />
                </td>
            </tr>
            <tr>
            <tr>
                <td class="tabla_separador"></td>
            </tr>
            <th colspan="4">Contacto</th>
            </tr>
            <tr>
                <td><label for="frm_movil">Telefono Movil</label></td>
                <td><input type="text" name="frm_movil" value="<?= $datos_emp['TelefonoMovil'] ?>" /></td>
                <td><label for="frm_fijo">Telefono Fijo</label></td>
                <td><input type="text" name="frm_fijo" value="<?= $datos_emp['TelefonoFijo'] ?>" /></td>
            </tr>
            <tr>
                <td><label for="frm_email">Email</label></td>
                <td><input type="text" name="frm_email" value="<?= $datos_emp['Email'] ?>" /></td>
                <td><label for="frm_ocontacto">Otro (Especificar en 100 caracteres)</label></td>
                <td><input type="text" name="frm_ocontacto" value="<?= $datos_emp['OtroContacto'] ?>" /></td>
            </tr>
            <tr>
            <tr>
                <td class="tabla_separador"></td>
            </tr>
            <th colspan="4">Datos de Trabajador</th>
            </tr>
            <tr>
                <td><label for="frm_usuario">Usuario</label></td>
                <td><input type="text" name="frm_usuario" name="frm_usuario" value="<?= $datos_emp['Login']; ?>" /></td>
                <td><label for="frm_clave">Contraseña</label></td>
                <td><input type="password" name="frm_clave"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>Repetir Constraseña</td>
                <td><input type="password" name="frm_clave2" /></td>
            </tr>
            <tr>
                <td width="25%"> <label for="frm_estado">Estado</label></td>
                <td width="25%">
                    <select name="frm_estado" placeholder="Seleccione">
                        <option value="0">Inactivo</option>
                        <option value="1">Activo</option>
                    </select>
                </td>
                <td width="25%"><label for="frm_departamento">Departamento</label></td>
                <td width="25%">
                    <select name="frm_departamento">
                        <option value="-1">Seleccione</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="tabla_separador"></td>
            </tr>
            <tr>
                <td align="center" colspan="4">
                    <input name="frm_actualizar" type="submit" value="Actualizar Mi informacion" />
                </td>
            </tr>
        </table>
    </form>
<?php
}
