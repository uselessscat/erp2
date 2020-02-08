<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Test</title>
    <script src="../javascript/jquery-1.11.1.js" type="text/javascript"></script>
</head>

<body>
    <div>
        post <textarea id="data" rows="4" cols="20"></textarea>
        <br />
        dir <input type="text" id="php" size="100" />
        <br />
        <input type="button" value="enviar" onclick="send()" /><input type="button" value="limpiar" onclick="limpiar()" />
    </div>
    <script type="text/javascript">
        function send() {
            $.post($("#php").val(), $("#data").val(), function(datos) {
                $("#res").html(datos);
            }).error(function() {
                alert("error!");
            });
        }

        function limpiar() {
            $("#res").html("");
        }
    </script>

    <div id="res" style="border-style: dashed;border-width: 1px;"></div>
    <input name="asd" type="text" />
    <form id="form1" name="form1" method="post" action="">
    </form>
</body>

</html>