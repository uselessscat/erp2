<?php
require_once "../php/conexion_mysql.php";
$conexion = ctar_nvl_0();

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Isapre.xls");

$sql_pre = "SELECT * FROM previsiosalud;";
$resul_pre = mysqli_query($conexion, $sql_pre);

$total = mysqli_num_rows($resul_pre);
?>
<div id="grilla">
    <h3 align="center">Isapre</h3>
    <div align="center">
        <table width="384" border="1">
            <tr>
                <th>idPrevision</th>
                <th>Nombre</th>
                <th>Rut</th>
                <th>Fono</th>
                <th>Direccion</th>
                <th>Ciudad_idCiudad</th>
            </tr>
            <?php
            while ($datos_pre = mysqli_fetch_array($resul_pre)) {
            ?>
                <tr>
                    <td><?= $datos_pre['idPrevision'] ?></td>
                    <td><?= $datos_pre['Nombre'] ?></td>
                    <td><?= $datos_pre['Rut'] ?></td>
                    <td><?= $datos_pre['Fono'] ?></td>
                    <td><?= $datos_pre['Direccion'] ?></td>
                    <td><?= $datos_pre['Ciudad_idCiudad'] ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>
</div>