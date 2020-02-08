<?php

function mysqli_field_name($result, $field_offset)
{
    $properties = mysqli_fetch_field_direct($result, $field_offset);
    return is_object($properties) ? $properties->name : null;
}

// necesita una consulta sql ($tg_sql),
// un id ($tg_id)para generar el campo id solo si se usa la funcion accion($tg_accion)
// ademas si el valor es null se puede reemplazar ($tg_ncv)// añadir reemplazo de valores
if (isset($tg_sql)) {
    $resultado = mysqli_query($conexion, $tg_sql);
    $total = mysqli_num_rows($resultado);

    //hacer tabla
?>
    <div align="center"><span>Total:
            <?= $total ?> Filas</span><br />
        <a href="#" onclick="imprimirTabla()">Imprimir<img src="../imagen/tema/printer.png" width="16" height="16" /></a>
        <a href="#" onclick="generarExcel()">Exportar a excel<img src="../imagen/tema/document_excel.png" width="16" height="16" /></a>
    </div>
    <div id="tg_tabla" class="tg_tabla">
        <table>
            <thead>
                <?php for ($i = 0; $i < mysqli_num_fields($resultado); $i++) { ?>
                    <th>
                        <?= mysqli_field_name($resultado, $i); ?>
                    </th>
                <?php }
                if (isset($tg_accion)) {
                ?>
                    <th class="tg_accion">
                        Accion
                    </th>
                <?php } ?>
            </thead>
            <?php for ($i = 0; $datos = mysqli_fetch_array($resultado); $i++) { ?>
                <tr class="<?= ($i % 2 == 0) ? "par" : "impar" ?>">
                    <?php for ($e = 0; $e < count($datos) / 2; $e++) { ?>
                        <td>
                            <?= (($datos[$e]) ? $datos[$e] : $tg_ncv) ?>
                        </td>
                    <?php
                    }
                    if (isset($tg_accion)) {
                    ?>
                        <td class="tg_accion">
                            <?= str_replace("\$id", $datos[$tg_id], $tg_accion) ?>
                        </td>
                    <?php } ?>

                </tr>
            <?php } ?>
        </table>
    </div>
<?php
} else {
    echo "no se han definido las variables necesarias par acompletar la operacion.";
}
?>