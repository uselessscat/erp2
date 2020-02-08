<?php

session_start();

if (isset($_SESSION['uid'])) {
    // redireccionar a la pagina o contenido segun los parametros
    $pagina = $_REQUEST['menu'];

    if (file_exists("paginas/portal_trabajador/$pagina.php")) {
        include "paginas/portal_trabajador/$pagina.php";
    } else {
        include 'paginas/portal_trabajador/inicio.php';
    }

    // si la funcion mostrar pnel no existe mostrar panel por defecto
    if (!function_exists('paneld')) {
        function paneld()
        {
            ?>
            <div id="listaopciones">
                <ul>
                    <li id="listatitulo">Modulos</li>
                    <li class="loitem"><a id="op_ipersonal" href="index.php?pg=portal_trabajador&menu=empleado_basico">Informacion Personal</a></li>
                    <li class="loitem"><a id="op_liquidacion" href="#">Liquidaciones</a></li>
                    <li class="loitem"><a id="op_certificados" href="#">Certificados</a></li>
                    <li class="loitem"><a id="op_prestamos" href="#">Prestamos y Anticipos</a></li>
                    <li class="loitem"><a id="op_asistencia" href="#">Asistencia, Vacaciones y Licencias</a></li>
                </ul>
            </div>
            <?php
        }
    }
} else {
    session_destroy();

    function contenido()
    {
        ?>
        <div style="text-align: center; width: 100%;">
            <form name="f_login" method="post" action="./php/iniciar_sesion.php">
                <table>
                    <tr>
                        <th colspan="2">Login de Empleados</th>
                    </tr>
                    <tr>
                        <td><label for="lg_usuario">USUARIO</label></td>
                        <td><input name="lg_usuario" type="text" /></td>
                    </tr>
                    <tr>
                        <td><label for="lg_contrasena">CONTRASEÑA</label></td>
                        <td><input name="lg_contrasena" type="password" /></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="mensaje"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><input name="Enviar" type="submit" value="Enviar" /></td>
                    </tr>
                </table>
            </form>
        </div>
        <?php
    }
}
