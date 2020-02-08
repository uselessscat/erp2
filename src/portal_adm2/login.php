<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
if (!isset($_SESSION['aid'])) {
?>
    <script type="text/javascript">
        function login() {
            $.post("./Funciones/iniciar_sesion.php",
                "usuario=" + $("#login_usuario").val() + "&contrasena=" + $("#login_contrasena").val(),
                function(r) {
                    poner(r, "panel");
                    cargar("./", "barralateral");
                });
        }
    </script>
    <h1>Portal Administrador</h1>
    <h3>iniciar sesion</h3>
    <table>
        <tr>
            <td>Login</td>
            <td><input id="login_usuario" type="text" /></td>
        </tr>
        <tr>
            <td>Contraseña</td>
            <td><input id="login_contrasena" type="password" /></td>
        </tr>
        <tr>
            <td colspan="2">
                <input name="input" type="button" value="Ingresar" onclick="login()" />
            </td>
        </tr>
    </table>
<?php } else { ?>
    <h3>Seleccione una opcion</h3>
<?php } ?>