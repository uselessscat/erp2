// JavaScript Documentfunction valida_envia(){
//valido el nombre
if (document.fvalida.nombre.value.length == 0) {
    alert("Tiene que escribir su nombre")
    document.fvalida.nombre.focus()
    return 0;
}

//valido la edad. tiene que ser entero mayor que 18
edad = document.fvalida.edad.value
edad = validarEntero(edad)
document.fvalida.edad.value = edad
if (edad == "") {
    alert("Tiene que introducir un número entero en su edad.")
    document.fvalida.edad.focus()
    return 0;
} else {
    if (edad < 18) {
        alert("Debe ser mayor de 18 años.")
        document.fvalida.edad.focus()
        return 0;
    }
}

//valido el interés
if (document.fvalida.interes.selectedIndex == 0) {
    alert("Debe seleccionar un motivo de su contacto.")
    document.fvalida.interes.focus()
    return 0;
}

//el formulario se envia
alert("Muchas gracias por enviar el formulario");
document.fvalida.submit();
}


function formulario(f) {
    if (f.nombre.value == '') {
        alert('El nombre esta vacío');
        f.nombre.focus(); return false;
    }
    if (f.email.value == '') {
        alert('El email esta vacío');
        f.email.focus(); return false;
    } return true;
}

// Se trata de forzar al usuario a introducir un valor en un cuadro de texto o textarea en los que sea obligatorio.La condición en JavaScript se puede indicar como:

valor = document.getElementById("campo").value;
if (valor == null || valor.length == 0 || /^\s+$/.test(valor)) {
    return false;
}
// Se trata de obligar al usuario a introducir un valor numérico en un cuadro de texto.La condición JavaScript consiste en:
valor = document.getElementById("campo").value;
if (isNaN(valor)) {
    return false;

    // Se trata de obligar al usuario a seleccionar un elemento de una lista desplegable.El siguiente código JavaScript permite conseguirlo:

    indice = document.getElementById("opciones").selectedIndex;
    if (indice == null || indice == 0) {
        return false;
    }

    // <select id="opciones" name="opciones">
    //     <option value="">- Selecciona un valor -</option>
    //     <option value="1">Primer valor</option>
    //     <option value="2">Segundo valor</option>
    //     <option value="3">Tercer valor</option>
    // </select>

    // Se trata de obligar al usuario a introducir una dirección de email con un formato válido.Por tanto, lo que se comprueba es que la dirección parezca válida, ya que no se comprueba si se trata de una cuenta de correo electrónico real y operativa.La condición JavaScript consiste en:

    valor = document.getElementById("campo").value;
    if (!(/\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)/.test(valor))) {
        return false;
    }

    // Las fechas suelen ser los campos de formulario más complicados de validar por la multitud de formas diferentes en las que se pueden introducir.El siguiente código asume que de alguna forma se ha obtenido el año, el mes y el día introducidos por el usuario:

    var ano = document.getElementById("ano").value;
    var mes = document.getElementById("mes").value;
    var dia = document.getElementById("dia").value;

    valor = new Date(ano, mes, dia);

    if (!isNaN(valor)) {
        return false;
    }

    // válido de Documento Nacional de Identidad o DNI.Aunque para cada país o región los requisitos del documento de identidad de las personas pueden variar, a continuación se muestra un ejemplo genérico fácilmente adaptable.La validación no sólo debe comprobar que el número esté formado por ocho cifras y una letra, sino que también es necesario comprobar que la letra indicada es correcta para el número introducido:

    valor = document.getElementById("campo").value;
    var letras = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E', 'T'];

    if (!(/^\d{8}[A-Z]$/.test(valor))) {
        return false;
    }

    if (valor.charAt(8) != letras[(valor.substring(0, 8)) % 23]) {
        return false;
    }
}


function validar(formulario) {
    var rut = formulario.rut.value;
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
