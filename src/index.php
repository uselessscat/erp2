<?php
//contruir la pagina de acuerdo a los parametros
//para mostrar el contenido dentro de modelo declarar las funciones 'contenido()' y 'paneld()'
//y dentro insertar el html

$pagina = $_REQUEST['pg'];

if (file_exists("paginas/$pagina.php")) {
    include "paginas/$pagina.php";
} else {
    header('Location: index.php?pg=inicio');
}

include 'paginas/modelo.php';
