
		function nif(dni) {
			var numero
			var letr
			var letra
			var expresion_regular_dni

			expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

			if(expresion_regular_dni.test (dni) == true){
				numero = dni.substr(0,dni.length-1);
				letr = dni.substr(dni.length-1,1);
				numero = numero % 23;
				letra='TRWAGMYFPDXBNJZSQVHLCKET';
				letra=letra.substring(numero,numero+1);
				if (letra!=letr.toUpperCase()) {
					alert('Wrong ID letter');
					return false;
				}else{

					return true;
				}
			}else{
				alert('Wrong ID format');
				return false;
			}
		}
		function validaCCC(val){
			var banco = val.substring(0,4);
			var sucursal = val.substring(4,8);
			var dc = val.substring(8,10);
			var cuenta=val.substring(10,20);
			var CCC = banco+sucursal+dc+cuenta;
			if (!/^[0-9]{20}$/.test(banco+sucursal+dc+cuenta)){
				return false;
			}
			else
			{
				valores = new Array(1, 2, 4, 8, 5, 10, 9, 7, 3, 6);
				control = 0;
				for (i=0; i<=9; i++)
					control += parseInt(cuenta.charAt(i)) * valores[i];
				control = 11 - (control % 11);
				if (control == 11) control = 0;
				else if (control == 10) control = 1;
				if(control!=parseInt(dc.charAt(1))) {
					return false;
				}
				control=0;
				var zbs="00"+banco+sucursal;
				for (i=0; i<=9; i++)
					control += parseInt(zbs.charAt(i)) * valores[i];
				control = 11 - (control % 11);
				if (control == 11) control = 0;
				else if (control == 10) control = 1;
				if(control!=parseInt(dc.charAt(0))) {
					return false;
				}
				return true;
			}
		}
        function validarEmail( email ) {
            expr = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
            if ( !expr.test(email) ) {
                return false;
            }
            else {
                return true;
            }
        }

		function validarFechaMenorActual(date){
			var x=new Date();
			var fecha = date.split("-");

			x.setFullYear(fecha[0],fecha[1]-1,fecha[2]);

			var today = new Date();

			if (x >= today)
				return false;
			else
				return true;
		}
		function valida_envia2(){

			if (document.form.ROL_NOM.value.length==0){
				alert("Enter role name");
				document.form.ROL_NOM.focus();
				return false;
			}
			if (document.form.ROL_NOM.value.length<2){
				alert("Role name too short (min 2 char)");
				document.form.ROL_NOM.focus();
				return false;
			}
			if (document.form.ROL_NOM.value.length>25){
				alert("Role name too long (max 25 char)");
				document.form.ROL_NOM.focus();
				return false;
			}
			return true;

		}
		function valida_envia3(){

			if (document.form.FUNCIONALIDAD_NOM.value.length==0){
				alert("Enter a valid name");
				document.form.FUNCIONALIDAD_NOM.focus();
				return false;
			}
			if (document.form.FUNCIONALIDAD_NOM.value.length<2){
				alert("Functionality name too short (min 2 char)");
				document.form.FUNCIONALIDAD_NOM.focus();
				return false;
			}
			if (document.form.FUNCIONALIDAD_NOM.value.length>50){
				alert("Functionality name too long (max 50 char)");
				document.form.FUNCIONALIDAD_NOM.focus();
				return false;
			}
			return true;

		}
		function valida_envia4(){

			if (document.form.PAGINA_NOM.value.length==0){
				alert("Enter a valid name");
				document.form.PAGINA_NOM.focus();
				return false;
			}
			if (document.form.PAGINA_NOM.value.length<2){
				alert("Page name too short (min 2 char)");
				document.form.PAGINA_NOM.focus();
				return false;
			}
			if (document.form.PAGINA_NOM.value.length>25){
				alert("Page name too long (max 25 char)");
				document.form.PAGINA_NOM.focus();
				return false;
			}
			return true;

		}
		//Nombramos la función
		function valida_envia(){

			if (document.form.EMP_USER.value.length==0){
				alert("Enter a valid username");
				document.form.EMP_USER.focus();
				return false;
			}
			if (document.form.EMP_USER.value.length<2){
				alert("Username too short (at least 2 char.)");
				document.form.EMP_USER.focus();
				return false;
			}
			if (document.form.EMP_USER.value.length>25){
				alert("Username too long (max. 25 char.");
				document.form.EMP_USER.focus();
				return false;
			}

//Validamos un campo o área de texto, por ejemplo el campo nombre
		

			if (document.form.EMP_PASSWORD.value.length==0){
				alert("Enter a valid password");
				document.form.EMP_PASSWORD.focus();
				return false;
			}
			if (document.form.EMP_PASSWORD.value.length<2){
				alert("Password too short (at least 2 char.)");
				document.form.EMP_PASSWORD.focus();
				return false;
			}
			if (document.form.EMP_PASSWORD.value.length>32){
				alert("Password too long (max. 32 char.)");
				document.form.EMP_PASSWORD.focus();
				return false;
			}
			if (document.form.EMP_NOMBRE.value.length==0){
				alert("Enter a valid name");
				document.form.EMP_NOMBRE.focus();
				return false;
			}
			if (document.form.EMP_NOMBRE.value.length<2){
				alert("Name too short (at least 2 char.)");
				document.form.EMP_NOMBRE.focus();
				return false;
			}
			if (document.form.EMP_NOMBRE.value.length>25){
				alert("Name too long (max. 25 char.");
				document.form.EMP_NOMBRE.focus();
				return false;
			}
			if (document.form.EMP_APELLIDO.value.length==0){
				alert("Enter a valid surname");
				document.form.EMP_APELLIDO.focus();
				return false;
			}
			if (document.form.EMP_APELLIDO.value.length<2){
				alert("Surname too short (at least 2 char.)");
				document.form.EMP_APELLIDO.focus();
				return false;
			}
			if (document.form.EMP_APELLIDO.value.length>50){
				alert("Surname too long (max. 50 char.");
				document.form.EMP_APELLIDO.focus();
				return false;
			}
			
			

			if(!nif(document.form.EMP_DNI.value)){
				document.form.EMP_DNI.focus();
				return false;
			}

			if(document.form.EMP_FECH_NAC.value==false){
				alert("Enter a birth date");
				document.form.EMP_FECH_NAC.focus();
				return false;
			}
            if ( !validarFechaMenorActual(document.form.EMP_FECH_NAC.value)){
                alert("¿Is he from the future?");
                document.form.EMP_FECH_NAC.focus();
                return false;
            }
            if (( (document.form.EMP_EMAIL.value.length = 0) || !validarEmail(document.form.EMP_EMAIL.value) )){
                alert("Enter a valid email address");
                document.form.EMP_EMAIL.focus();
                return false;
            }
            valor = document.form.EMP_TELEFONO.value;
            if( !(/^\d{9}$/.test(valor)) ) {
                alert("Enter a valid telephone number");
                document.form.EMP_TELEFONO.focus();
                return false;
            }

            if (document.form.EMP_CUENTA.value.length==0 || !validaCCC(document.form.EMP_CUENTA.value)){
                alert("Enter a valid CCC account number");
                document.form.EMP_CUENTA.focus();
                return false;
            }




			if (document.form.EMP_DIRECCION.value.length==0){
				alert("Enter address");
				document.form.EMP_DIRECCION.focus();
				return false;
			}

			return true;
		}

		



