function enviar(datos) {
    // validar
    if (datos.validar()) {
        datos.convertir();
        alert(JSON.stringify(datos));
        $.post(getDir(), "datos=" + JSON.stringify(datos),
            function(data) {
                alert(data);

                cargar(getDir(), 'panel');
            }
        );
    }
}

function ingresarDatos(datos) {
    $.post("./Funciones/qry_ingresarForm.php", datos,
        function(data) {
            alert(data);
            cargar(getDir(), 'panel');
        }
    );
}

function modificarDatos(datos) {
    $.post("./Funciones/qry_modificarForm.php", datos,
        function(data) {
            alert(data);
            cargar(getDir(), 'panel');
        }
    );
}

function eliminarDatos(datos) {
    $.post("./Funciones/qry_eliminarForm.php", datos,
        function(data) {
            alert(data);
            cargar(getDir(), 'panel');
        }
    );
}

function imprimirTabla() {
    var ficha = document.getElementById("tg_tabla");
    var ventimp = window.open(' ', 'popimpr');
    ventimp.document.write(ficha.innerHTML);
    ventimp.document.close();
    ventimp.print();
    ventimp.close();
}

function generarExcel() {
    window.open("./Funciones/generarExcel.php?_excel=" + $("#tg_tabla").html().toString());
}