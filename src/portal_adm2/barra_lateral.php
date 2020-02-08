<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
?>
<h3>Menu opciones</h3>
<?php if (!isset($_SESSION['aid'])) { ?>
    <div class="logininfo">
        <p>Inicie sesion para ver contenido</p>
    </div>
<?php } else { ?>
    <div class="logininfo">
        <p><b>Bienvenido: </b><br />
            <?= $_SESSION['nombre'] ?>
            [
            <?= $_SESSION['login'] ?>
            ]
            <?= $_SESSION['apellido'] ?>
            <br />
            <a href="./Funciones/cerrar_sesion.php">Cerrar sesion</a></p>
    </div>
    <div class="menu_opciones">
        <hr />
        <b>Mantenedores</b><br />
        <a href="#" onclick="cargar('form_empleado.php', 'panel')">Empleados (Datos Personales)</a><br />
        <a href="#" onclick="cargar('form_datosempleado.php', 'panel')">Empleados (Otros Datos)</a><br />
        <a href="#" onclick="cargar('form_centrocosto.php', 'panel')">Centros de Costos</a><br />
        <a href="#" onclick="cargar('form_prevision.php', 'panel')">Prevision Salud</a><br />
        <a href="#" onclick="cargar('form_afp.php', 'panel')">AFPs</a> <br />
        <hr />
        <b>Operaciones</b><br />
        <a href="#" onclick="cargar('form_relacion_contrato.php', 'panel')">Contratos de empleado</a><br />
        <a href="#" onclick="cargar('form_relacion_finiquito.php', 'panel')">Finiquitos de Empleado</a><br />
        <a href="#" onclick="cargar('form_permisos.php', 'panel')">Asignar Permisos</a><br />
        <a href="#" onclick="cargar('form_buscar_empleado.php', 'panel')">Buscar Empleados</a><br />
        <a href="#" onclick="cargar('form_calculoparametrico.php', 'panel')">Liquidacion</a><br />
        <br />
    </div>
<?php } ?>