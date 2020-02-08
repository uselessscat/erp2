<?php
require 'conexion_mysql.php';
$conexion = ctar_nvl_0();

header('Content-Type: application/vnd.ms-excel');
header('content-disposition: attachment;filename=AFP.xls');
$sql_afp = "SELECT * FROM afp;";
$resul_afp = mysqli_query($conexion, $sql_afp);

$total = mysqli_num_rows($resul_afp);
?>

<div id="grilla">
    <div align="center"><a href="../php/pdf_contrato"></a>
        <h3>AFP</h3>
        <table border="1">
            <tr>
                <th>Codigo</th>
                <th>Rut</th>
                <th>NombreAFP</th>
                <th>Porcentaje</th>
                <th>Estado</th>
                <th>Ciudad</th>
            </tr>
            <?php
            while ($datos_afp = mysqli_fetch_array($resul_afp)) {
            ?>
                <tr>
                    <td><?= $datos_afp["idAfp"] ?></td>
                    <td><?= $datos_afp["Rut"] ?></td>
                    <td><?= $datos_afp["Nombre"] ?></td>
                    <td><?= $datos_afp["Porcentaje"] ?></td>
                    <td><?= $datos_afp["Estado"] ?></td>
                    <td><?= $datos_afp["Ciudad_idCiudad"] ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>