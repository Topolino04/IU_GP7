
function nif(dni) {
    var numero
    var letr
    var letra
    var expresion_regular_dni

    expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

    if (expresion_regular_dni.test(dni) == true) {
        numero = dni.substr(0, dni.length - 1);
        letr = dni.substr(dni.length - 1, 1);
        numero = numero % 23;
        letra = 'TRWAGMYFPDXBNJZSQVHLCKET';
        letra = letra.substring(numero, numero + 1);
        if (letra != letr.toUpperCase()) {
            alert('Dni erróneo, la letra del NIF no se corresponde');
            return false;
        } else {

            return true;
        }
    } else {
        alert('Dni erroneo, formato no válido');
        return false;
    }
}
function validaCCC(val) {
    var banco = val.substring(0, 4);
    var sucursal = val.substring(4, 8);
    var dc = val.substring(8, 10);
    var cuenta = val.substring(10, 20);
    var CCC = banco + sucursal + dc + cuenta;
    if (!/^[0-9]{20}$/.test(banco + sucursal + dc + cuenta)) {
        return false;
    } else
    {
        valores = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
        control = 0;
        for (i = 0; i <= 9; i++)
            control += parseInt(cuenta.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11)
            control = 0;
        else if (control == 10)
            control = 1;
        if (control != parseInt(dc.charAt(1))) {
            return false;
        }
        control = 0;
        var zbs = "00" + banco + sucursal;
        for (i = 0; i <= 9; i++)
            control += parseInt(zbs.charAt(i)) * valores[i];
        control = 11 - (control % 11);
        if (control == 11)
            control = 0;
        else if (control == 10)
            control = 1;
        if (control != parseInt(dc.charAt(0))) {
            return false;
        }
        return true;
    }
}
function validarEmail(email) {
    expr = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
    if (!expr.test(email)) {
        return false;
    } else {
        return true;
    }
}

function validarFechaMenorActual(date) {
    var x = new Date();
    var fecha = date.split("-");

    x.setFullYear(fecha[0], fecha[1] - 1, fecha[2]);

    var today = new Date();

    if (x >= today)
        return false;
    else
        return true;
}
function valida_envia2() {

    if (document.form.ROL_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.ROL_NOM.focus();
        return false;
    }
    if (document.form.ROL_NOM.value.length < 2) {
        alert("Nombre del rol demasiado corto (min 2 caracteres)");
        document.form.ROL_NOM.focus();
        return false;
    }
    if (document.form.ROL_NOM.value.length > 25) {
        alert("Nombre del rol demasiado largo (max 25 caracteres)");
        document.form.ROL_NOM.focus();
        return false;
    }
    return true;

}
function valida_envia3() {

    if (document.form.FUNCIONALIDAD_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    if (document.form.FUNCIONALIDAD_NOM.value.length < 2) {
        alert("Nombre de la funcionalidad demasiado corto (min 2 caracteres)");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    if (document.form.FUNCIONALIDAD_NOM.value.length > 50) {
        alert("Nombre de la funcionalidad demasiado largo (max 50 caracteres)");
        document.form.FUNCIONALIDAD_NOM.focus();
        return false;
    }
    return true;

}
function valida_envia4() {

    if (document.form.PAGINA_NOM.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    if (document.form.PAGINA_NOM.value.length < 2) {
        alert("Nombre de la página  demasiado corto (min 2 caracteres)");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    if (document.form.PAGINA_NOM.value.length > 25) {
        alert("Nombre de la página demasiado largo (max 25 caracteres)");
        document.form.PAGINA_NOM.focus();
        return false;
    }
    return true;

}

//----------------------------------------------------------
function valida_envia_PAGO() {

if (!nif(document.form.CLIENTE_DNI.value)) {
        document.form.CLIENTE_DNI.focus();
        return false;
    }
    
    if (document.form.PAGO_CONCEPTO.value.length == 0) {
        alert("Introduzca un valor para el concepto");
        document.form.PAGO_CONCEPTO.focus();
        return false;
    }
    if (document.form.PAGO_CONCEPTO.value.length > 200) {
        alert("Concepto de pago demasiado largo (max 200 caracteres)");
        document.form.PAGO_CONCEPTO.focus();
        return false;
    }
    if (document.form.PAGO_IMPORTE.value.length == 0) {
        alert("Introduzca un valor para el importe");
        document.form.PAGO_IMPORTE.focus();
        return false;
    }
    if (document.form.PAGO_IMPORTE.value.length > 10) {
        alert("Importe demasiado largo (max 10 caracteres)");
        document.form.PAGO_IMPORTE.focus();
        return false;
    }
    return true;
}
//----------------------------------------------------------

//Nombramos la función
function valida_envia() {
    if (document.form.EMP_USER.value.length == 0) {
        alert("Introduzca un valor para el usuario");
        document.form.EMP_USER.focus();
        return false;
    }
    if (document.form.EMP_USER.value.length < 2) {
        alert("Nombre de usuario demasiado corto (mínimo 2 caracteres)");
        document.form.EMP_USER.focus();
        return false;
    }
    if (document.form.EMP_USER.value.length > 25) {
        alert("Nombre de usuario demasiado largo (máximo 25 caracteres)");
        document.form.EMP_USER.focus();
        return false;
    }

    if (document.form.EMP_PASSWORD.value.length == 0) {
        alert("Introduzca un valor para la contraseña");
        document.form.EMP_PASSWORD.focus();
        return false;
    }

    if (document.form.EMP_PASSWORD.value.length < 2) {
        alert("Contraseña demasiado corta (mínimo 2 caracteres)");
        document.form.EMP_PASSWORD.focus();
        return false;
    }

    if (document.form.EMP_PASSWORD.value.length > 32) {
        alert("Contraseña demasiado larga (máximo 32 caracteres)");
        document.form.EMP_PASSWORD.focus();
        return false;
    }

//Validamos un campo o área de texto, por ejemplo el campo nombre
    if (document.form.EMP_NOMBRE.value.length == 0) {
        alert("Introduzca un valor para el nombre");
        document.form.EMP_NOMBRE.focus();
        return false;
    }
    if (document.form.EMP_NOMBRE.value.length < 2) {
        alert("Nombre demasiado corto (mínimo 2 caracteres)");
        document.form.EMP_NOMBRE.focus();
        return false;
    }
    if (document.form.EMP_NOMBRE.value.length > 25) {
        alert("Nombre demasiado largo (máximo 25 caracteres)");
        document.form.EMP_NOMBRE.focus();
        return false;
    }


    if (document.form.EMP_APELLIDO.value.length == 0) {
        alert("Introduzca un valor para el apellido");
        document.form.EMP_APELLIDO.focus();
        return false;
    }
    if (document.form.EMP_APELLIDO.value.length < 2) {
        alert("Apellido demasiado corto (mínimo 2 caracteres)");
        document.form.EMP_APELLIDO.focus();
        return false;
    }
    if (document.form.EMP_APELLIDO.value.length > 50) {
        alert("Apellido demasiado largo (máximo 50 caracteres)");
        document.form.EMP_APELLIDO.focus();
        return false;
    }



    if (!nif(document.form.EMP_DNI.value)) {
        document.form.EMP_DNI.focus();
        return false;
    }

    if (document.form.EMP_FECH_NAC.value == false) {
        alert("Introduzca un valor  para la fecha de nacimiento");
        document.form.EMP_FECH_NAC.focus();
        return false;
    }
    if (!validarFechaMenorActual(document.form.EMP_FECH_NAC.value)) {
        alert("¿Viene del futuro?");
        document.form.EMP_FECH_NAC.focus();
        return false;
    }
    if (((document.form.EMP_EMAIL.value.length == 0) || !validarEmail(document.form.EMP_EMAIL.value))) {
        alert("Introduzca una dirección de email válida");
        document.form.EMP_EMAIL.focus();
        return false;
    }
    valor = document.form.EMP_TELEFONO.value;
    if (!(/^\d{9}$/.test(valor))) {
        alert("Tiene que escribir un teléfono de 9 dígitos");
        document.form.EMP_TELEFONO.focus();
        return false;
    }

    if (document.form.EMP_CUENTA.value.length == 0 || !validaCCC(document.form.EMP_CUENTA.value)) {
        alert("Introduzca un valor correcto para el numero de CCC(sin espacios)");
        document.form.EMP_CUENTA.focus();
        return false;
    }




    if (document.form.EMP_DIRECCION.value.length == 0) {
        alert("Introduzca dirección");
        document.form.EMP_DIRECCION.focus();
        return false;
    }




    return true;

}








