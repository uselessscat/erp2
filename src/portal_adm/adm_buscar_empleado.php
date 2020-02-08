<?php
// iniciar sesion y comprobar que esta registrado
session_start();

//conectar con la base datos
require_once "../php/conexion_mysql.php";

$conexion = ctar_nvl_0();
?>
<html lang="es">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#btn_buscar").click(function() {
                $('#grilla2').show(); //muestro mediante id

            });

        });
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
    <script language="javascript">
        $(document).ready(function() {
            $(".botonExcel").click(function(event) {
                $("#datos_a_enviar").val($("<div>").append($("#Exportar_a_Excel").eq(0).clone()).html());
                $("#FormularioExportacion").submit();
            });
        });
    </script>
    <meta charset="utf-8">
</head>
<body>
    <div id=pag>
        <form action="index.php?pg=adm_buscar_empleado" method="post">
            <div align="center">
                <table width="329" border="0" cellspacing="1">
                    <tr>
                        <td colspan="2">
                            <div align="center">Busqueda de Trabajador</div>
                        </td>
                    </tr>
                    <tr>
                        <td width="145">&nbsp;</td>
                        <td width="171">&nbsp;</td>
                    </tr>
                    <tr>
                        <td><input type="text" name="frm_buscar" id="frm_buscar"></td>
                        <td><input type="submit" name="btn_buscar" id="btn_buscar" value="Buscar" required onClick="cargar('#pag', 'index.php?pg=adm_buscar_empleado');"></td>
                    </tr>
                    <tr>
                        <td>
                            <p>
                                <label>
                                    <input name="tipo" type="radio" id="tipo_0" value="1" checked="CHECKED">
                                    Nombre</label>
                                <label>
                                    <input type="radio" name="tipo" value="2" id="tipo_1">
                                    Rut</label>
                                <br>
                            </p>
                        </td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
            </div>
        </form>
        <script>
            function cargar(div, desde) {
                $(div).load(desde);
            }
        </script>
        <?php
        $selected_val = $_POST['tipo'];
        $campo = $_POST['frm_buscar'];
        ?>
        <p>&nbsp;</p>

        <?php
        if ($selected_val == 1) {
            $sql = "select * from empleado where Nombres LIKE '" . $campo . "%'";
            $resul_emp = mysql_query($sql);
        }
        if ($selected_val == 2) {
            $sq2 = "select * from empleado where DocumentoIdentidad LIKE '" . $campo . "%'";
            $resul_emp = mysql_query($sq2);
        }
        ?>

        <div id="grilla2" style="border-radius:2px">
            <div align="center">
                <?php if ($selected_val >= 1) { ?>
                    <table border="1" style="border-radius:6px" id="Exportar_a_Excel">
                        <tr class="font_titulos_grilla">
                            <th>Rut</th>
                            <th>Nombres</th>
                            <th>Email</th>
                            <th>Sexo</th>
                            <th>Telefono Movil</th>
                            <th>Usuario</th>
                        </tr>
                        <?php

                        while ($datos_emp = mysqli_fetch_array($resul_emp)) {
                        ?>
                            <tr>
                                <td height="22"><?= $datos_emp['DocumentoIdentidad']; ?></td>
                                <td><?php echo $datos_emp['Nombres'] . " " . $datos_emp['ApellidoPaterno'] . " " . $datos_emp['ApellidoMaterno']; ?></td>
                                <td><?php echo $datos_emp['Email']; ?></td>
                                <td><?php if ($datos_emp['Sexo'] == 0) {
                                        echo "Masculino";
                                    } else {
                                        echo "Femenino";
                                    } ?></td>
                                <td><?php echo $datos_emp['TelefonoMovil']; ?></td>
                                <td><?php echo $datos_emp['Login']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </table>
                <?php } else {
                } ?>

                <form action="../php/excl_busq_emp.php" method="post" target="_blank" id="FormularioExportacion">
                    <p align="center">Exportar a Excel <img src="../imagen/tema/document_excel.png" width="16" height="16" class="botonExcel" /> Imprimir <a href="javascript:imprimirSelec('grilla2')"><img src="../imagen/tema/printer.png" width="16" height="16" /></a>
                        <input type="hidden" id="datos_a_enviar" name="datos_a_enviar" />
                    </p>
                </form>
            </div>
        </div>

    </div>
</body>
</body>

</html>