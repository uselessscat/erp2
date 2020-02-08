// JavaScript Document

// usa la libreria Jquery
function validador_Rut(campo) { //
  campo.blur(function () {// al cambiar foco
    var txt = campo.val();
    txt = txt.replace(/\./g, "").replace(/-/g, ""); // con "/expresion/g" se reemplazan todas
    var r = txt.slice(0, txt.length - 1);
    var d = txt.slice(txt.length - 1, txt.length);

    var M = 0, S = 1;
    for (; r; r = Math.floor(r / 10))
      S = (S + r % 10 * (9 - M++ % 6)) % 11;

    if ((S ? S - 1 : 'K') == d) {
      //formatear
      campo.css("background-color", "");

    } else {
      //poner en rojo
      campo.css("background-color", "red");
    }
  });
}

function validador_Email(campo) {
  campo.blur(function () {// al cambiar foco
    var expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (expr.test(campo.val())) {
      campo.css("background-color", "");
    } else {
      campo.css("background-color", "red");
    }
  });
}


