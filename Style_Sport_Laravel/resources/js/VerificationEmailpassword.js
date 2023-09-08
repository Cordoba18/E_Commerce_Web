


let email =  document.querySelector('#email').innerHTML;
let correo =  document.querySelector('#correo');
let btn_siguiente = document.querySelector("#btn_siguiente");
let contenedor = document.querySelector(".contenedor");
//validar si existe el correo del usuario
if (email == "") {

    alert("LO SIENTO! Algo estuvo mal. Vuelve a intentarlo");
    window.location.href = "recoverpassword";

}


correo.innerHTML = email;


//validar si el codigo ingresado es real y si lo es genera el formulario para cambiar contraseña si no manda un mensaje de codigo incorrecto
btn_siguiente.addEventListener("click", (e) => {
    e.preventDefault();
    let codigo = document.querySelector("#codigo").value;
    const _token = document.querySelector("input[name=_token]").value;
    $.ajax({
        type: "POST",
        url: "validate/code",
        data:{
            correo:email,
            codigo:codigo,
            _token: _token,
        },
        success: function(response) {

            if (response['message'] == true) {

                Swal.fire(
                    'CORREO VERIFICADO',
                     'CODIGO CORRECTO',
                     'success'
                    )

                    contenedor.innerHTML = ` <main class="wrapper">
                    <h1>CAMBIAR CONTRASEÑA</h1>
                    <form>
                        <input type="password" name="password" id="password" placeholder="Contraseña">
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirmar Contraseña">
                        <p hidden id="error" style="color: red; width: 100%"></p>
                        <button type="submit" id="btn_cambiar_contrasena">CAMBIAR CONTRASEÑA</button>
                    </form>
                </main>`;
                validaciones(_token);
            } else {

                Swal.fire({
                    icon: 'error',
                    title: 'CODIGO INCORRECTO',
                    text: 'Asegurese de escribir el codigo enviado al correo'
                })

            }

            // Manejar la respuesta del controlador si es necesario


        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
            console.log(dataArray);
        }
    });

})
//Despues del tiempo limite de 5 minutos se elimina el codigo y se retorna a la vista anterior para volver a intentar hacer el registro
    setTimeout(() => {

        $.ajax({
        type: "GET",
        url: "delete/code/" +email+"",
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
           alert('CODIGO ELIMINADO');
           window.location.href = "index";

        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });

    }, 300000);


//metodo para validar los inputs
function validaciones(_token) {

    let error = document.querySelector("#error");
    let btn_cambiar_contrasena = document.querySelector("#btn_cambiar_contrasena");
    btn_cambiar_contrasena.addEventListener("click", function(e) {
        e.preventDefault();
        let password = document.querySelector("#password").value;
        let password_confirmation = document.querySelector("#password_confirmation").value;
        //validaciones
        if (password == "") {
            error.innerHTML = "Contraseña Vacia";
            error.removeAttribute('hidden');
        }else if(password != password_confirmation){
            error.innerHTML = "Las contraseñas no coinciden";
            error.removeAttribute('hidden');
        } else if(!tieneMayuscula(password) ||  !tieneMinuscula(password) || !tieneNumero(password)){
            error.innerHTML = "La contraseña debe contener al menos una mayuscula, una minuscula y un numero";
            error.removeAttribute('hidden');
        }else if(!largocontrasena(password)) {
            error.innerHTML = "La contraseña debe ser de mayor a 8 o menor a 15 caracteres";
            error.removeAttribute('hidden');
        }else{
            //cambio de contraseña
            $.ajax({
                type: "POST",
                url: "change_password",
                data:{
                    email:email,
                    password:password,
                    _token: _token,
                },
                success: function(response) {
                    if (response['message'] == true) {
                        Swal.fire(
                            'CONTRASEÑA CAMBIADA',
                             'Hemos cambiado tu contraseña con exito!',
                             'success'
                            )
                            setTimeout(() => {
                                window.location.href = "../login_inicio";
                            }, 2000);
                    }
                }});
        }
    })


    //metodo para encontrar mayusculas en un texto
    function tieneMayuscula(texto) {
        for (let i = 0; i < texto.length; i++) {
            if (texto[i] !== texto[i].toLowerCase()) {
                return true;
            }
        }
        return false;
    }
        //metodo para encontrar minusculas en un texto
    function tieneMinuscula(texto) {
        for (let i = 0; i < texto.length; i++) {
            if (texto[i] !== texto[i].toUpperCase()) {
                return true;
            }
        }
        return false;
    }
    //metodo para encontrar numeros en un texto
    function tieneNumero(texto) {
        for (let i = 0; i < texto.length; i++) {
            if (!isNaN(texto[i])) {
                return true;
            }
        }
        return false;
    }
        //mvalidar el largo permitido de la contraseña

    function largocontrasena(texto) {
     if (texto.length > 15 || texto.length < 8) {
        return false;
     }else{
        return true;
     }
    }
}

