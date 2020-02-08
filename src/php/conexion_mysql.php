<?php

function ctar_nvl_0()
{
    // administrador todos los privilegios
    $conexion = mysqli_connect('db', 'root', 'password');

    mysqli_select_db($conexion, 'erp');
    return $conexion;
}

function ctar_nvl_1()
{
    // usuario con privilegios

}

function ctar_nvl_2()
{
    //trabajador modifica solo sus datos y genera ciertas consultas
    $conexion = mysqli_connect('db', 'root', 'password');
    mysqli_select_db($conexion, 'erp');

    return $conexion;
}
