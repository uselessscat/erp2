<?php
require "conexion_mysql.php";
$conexion = ctar_nvl_0();

header("Content-Type: application/vnd.ms-excel");
header("content-disposition: attachment;filename=Centros.xls");

$sql_centro = "SELECT * FROM centrocosto";
$resul_centro = mysqli_query($conexion, $sql_centro);
$total = mysqli_num_rows($resul_centro);

?>

<h1 align="center"> Centro de Costos </h1>
<table width="100%" border="1" cellspacing="1">
    <tr>
        <th>ID Centro Costo</th>
        <th>Nombre Centro Costo</th>
        <th>Encargado</th>
        <th>Centro Costo Padre</th>
        <th>Fecha</th>
    </tr>
    <?php
    while ($datos = mysqli_fetch_array($resul_centro)) {
    ?>
        <tr>
            <td><?= $datos["idCentroCosto"]; ?></td>
            <td><?= $datos["Nombre"]; ?></td>
            <td><?= $datos["Encargado_idEmpleado"]; ?></td>
            <td><?= $datos["CentroCostoPadre"]; ?></td>
            <td><?= $datos["Fecha"]; ?></td>
        </tr>
    <?php
    }
    ?>
</table>