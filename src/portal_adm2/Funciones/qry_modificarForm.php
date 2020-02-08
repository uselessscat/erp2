<?php

require_once './conexion_mysql.php';

/*
 * PARAMETROS
 * (con el signo '_' son parametros para la funcion)
 * _tabla   > la tabla donde se realiza la operacion
 *
 * (con el signo '-' son campos para la tabla)
 *  EJ:
 * -nombreusuario
 * -login
 *
 */

$sql = stripslashes("UPDATE {$_POST["_t"]} SET " . getCampos() . " WHERE {$_POST["_pk"]} = {$_POST["-" .$_POST["_pk"]]};");
echo $sql;
$result = mysqli_query($conexion, $sql);

$error = mysqli_error($conexion);
echo ($error != '') ? $error : "Ingresado correctamente";

function filtroVariables($a)
{
    if ($a{0} == '-') {
        return $a;
    }
}

function getCampos()
{
    $keys = array_filter(array_keys($_POST), 'filtroVariables');
    $str = "";
    print_r($keys);
    for ($i = 0, $c = false; $i < count($_POST); $i++) {
        if ($keys[$i] != "") {
            // && $_POST[$keys[$i]] != "" // no se usa,si qero djar un campo vacio no se actualiza
            $_POST[$keys[$i]] = ($_POST[$keys[$i]] == "") ? "NULL" : $_POST[$keys[$i]];

            $str .= (($c != false) ? ", " : "") . substr($keys[$i], 1) . " = " . $_POST[$keys[$i]];
            if ($c == false) {
                $c = true;
            }
        }
    }
    return $str;
}
