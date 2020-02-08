function valida_rut(string) {
    var rut = string;
    var count = 0;
    var count2 = 0;
    var factor = 2;
    var suma = 0;
    var sum = 0;
    var digito = 0;
    count2 = rut.length - 1;
    while (count < rut.length) {
        sum = factor * (parseInt(rut.substr(count2, 1)));
        suma = suma + sum;
        sum = 0;
        count = count + 1;
        count2 = count2 - 1;
        factor = factor + 1;
        if (factor > 7) {
            factor = 2;
        }
    }
    digito = 11 - (suma % 11);
    if (digito == 11) {
        digito = 0;
    }
    if (digito == 10) {
        digito = "k";
    }
    form.dig.value = digito;
}

function ingresarDatos() {
    var flds = $('.enviar');
    var str = "";
    for (var i = 0; i < flds.length; i++) {
        str += flds.eq(i).val() + "\n";
        if (flds.eq(i).val() == "") {
            flds.eq(i).css("border-color", "red");
            flds.eq(i).parent().append("<span class=\"valmsg\">Error</span>");
        } else {
            flds.eq(i).css("border-color", "gray");
            flds.eq(i).parent().children().filter(".valmsg").remove();
        }
    }
}