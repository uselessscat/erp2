<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" content="text/html" http-equiv="Content-Type" />
    <title>
        Index
    </title>
    <meta content="" name="keywords" />
    <meta content="" name="description" />

    <link href="./estilo/estilo_principal.css" rel="stylesheet" type="text/css" />

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="./javascript/index.js" type="text/javascript"></script>
</head>

<body>
    <div id="pagina">
        <div style="width: 100%; height: 80px;">
            <header id="cabecera">
                <img id="logo" src="./imagen/logods.png" />
                <h1>
                    No hay ninguno mas Penka que nosotros...
                </h1>
                <div id="barraayuda">
                    <li>
                        <ul>
                            <a href="#" id="mostrarlogin">
                                Ingresar
                            </a>
                        </ul>
                        <ul>
                            <a href="#" id="mostrarlogin">
                                Ingresar
                            </a>
                        </ul>
                        <ul>
                            <a href="#" id="mostrarlogin">
                                Ingresar
                            </a>
                        </ul>
                    </li>
                </div>
            </header>
        </div>
        <aside id="paneli"></aside>
        <div class="panelcentral">
            <div id="menu_">
                <ul>
                    <li>
                        <a href="index.php?pg=inicio" id="menu_index">
                            01
                            <span>
                                INICIO
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?pg=compania" id="menu_compania">
                            02
                            <span>
                                COMPAÑIA
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?pg=servicios" id="menu_servicios">
                            03
                            <span>
                                SERVICIOS
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="index.php?pg=portal_trabajador" id="menu_portal">
                            04
                            <span>
                                <?= "PORTAL EMPLEADOS" ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
            <section id="contenido">
                <?php
                if (function_exists('contenido')) {
                    contenido();
                }
                ?>
            </section>
        </div>
        <aside id="paneld">
            <?php
            if (function_exists('paneld')) {
                paneld();
            }
            ?>
        </aside>
        <div style="width: 100%; height: 50px; clear: both;"></div>
        <footer id="pie_pagina">
            Derechos reservados © 2014 Penkas Limitada.
        </footer>
    </div>
</body>

</html>