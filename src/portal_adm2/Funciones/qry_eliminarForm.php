<?php

require_once './conexion_mysql.php';

/*
 * PARAMETROS
 * (con el signo '_' son parametros para la funcion)
 * _funcion > la funcion
 * _tabla   > la tabla donde se realiza la operacion
 * _pk      > el campo que se evalua en el where
 *
 * (con el signo '-' son campos para la tabla)
 * -{contenido de _pk} > debe contener el nombre del campo y el valor
 * ej => si {_pk = idTabla}, entonces el parametro debe ser
 * {-idTabla = 5}.
 */

$sql = "DELETE FROM {$_POST["_t"]} WHERE {$_POST["_pk"]} = {$_POST["-" .$_POST["_pk"]]} LIMIT 1;";
$result = mysqli_query($conexion, $sql);

$error = mysqli_error($conexion);
echo ($error != '') ? $error : "Eliminado correctamente";
