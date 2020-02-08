<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/themes/smoothness/jquery-ui.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../javascript/calendario.js"></script>
    <link rel="stylesheet" type="text/css" href="../estilo/estilo_adm.css" />

    <script type="text/javascript">
        function cargar(div, desde) {
            $(div).load(desde);
        }
    </script>
    <title>Portal admistrador</title>
</head>

<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <div class="contenedor">
        <div class="barralateral">
            <h3>Menu opciones</h3>
            <?php if (!isset($_SESSION['aid'])) { ?>
                <div class="ses_noinicia">Inicie sesion para ver contenido</div>
            <?php } else { ?>
                <div class="ses_iniciado">
                    <div id="sesioninfo"> <b>Bienvenido: </b><br />
                        <?= $_SESSION['nombre'] ?>
                        [
                        <?= $_SESSION['login'] ?>
                        ]
                        <?= $_SESSION['apellido'] ?>
                        <br />
                        <a href="adm_iniciar_sesion.php?sesion=cerrar">Cerrar sesion</a> </div>
                </div>
                <h4>Mantenedores</h4>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_empleado\">Empleados (Datos Personales)</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_datosempleado\">Empleados (Otros Datos)</a><br/>" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_centrocosto\">Centros de Costos</a><br/>" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_prevision\">Prevision Salud</a><br/>" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_afp\">AFPs</a>" : "Sin permisos<br/>" ?>
                <br />
                <br />
                <hr />
                <h4>Operaciones</h4>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_relacion_contrato\">Contratos de empleado</a><br/>" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_relacion_finiquito\">Finiquitos de Empleado</a>" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_permisos\">Asignar Permisos</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_buscar_empleado\">Buscar Empleados</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_relacion_segurosalud\">Asignar prevision salud</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_relacion_finiquito\">Asignar Finiquitos</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_relacion_afp\">Asignar AFP</a><br />" : "Sin permisos<br/>" ?>
                <?= ($_SESSION['admlv'] <= 0) ? "<a href=\"index.php?pg=adm_datosempleado\">Asignar Afp y isapre</a><br />" : "Sin permisos<br/>" ?>
                <br />
            <?php } ?>
        </div>
        <div id="contenido">
            <?php if (!isset($_SESSION['aid'])) { ?>
                <div class="ses_noinicia">
                    <h1>Portal Administrador</h1>
                    <h3>iniciar sesion</h3>
                    <form name="isesion" method="post" action="adm_iniciar_sesion.php">
                        <table width="20%" border="0" cellspacing="1">
                            <tr>
                                <td>Login</td>
                                <td><input name="usuario" type="text" /></td>
                            </tr>
                            <tr>
                                <td>Contraseña</td>
                                <td><input name="contrasena" type="password" /></td>
                            </tr>
                            <tr>
                                <td colspan="2"><input name="input" type="submit" value="Ingresar" /></td>
                            </tr>
                        </table>
                        <br />
                        <br />
                        <br />
                    </form>
                </div>
            <?php } else { ?>
                <div class="ses_iniciado">
                    <?php
                    if (isset($_GET['pg'])) {
                        include $_GET['pg'] . ".php";
                    } else {
                    ?>
                        <h3>Seleccione una opcion</h3>
                <?php
                    }
                }
                ?>
                </div>
        </div>
    </div>
</body>

</html>