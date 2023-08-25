let finalizar_compra = document.querySelector("#finalizar_compra");
let departamentos = document.querySelectorAll('#departamentos');
let ciudades = document.querySelector('#ciudades');



finalizar_compra.addEventListener("click", function(e){

    let departamento = document.querySelector('#departamentos');
    let error_telefono = document.querySelector("#error_telefono");
    let error_direccion = document.querySelector("#error_direccion");
    let error_identificacion = document.querySelector('#error_identificacion');
    let contenedor_inputs = document.querySelector(".contenedor_inputs");
    let error_ciudad = document.querySelector("#error_ciudad");
        let telefono = document.querySelector('#telefono');
        let direccion = document.querySelector('#direccion');
        let identificacion = document.querySelector('#identificacion');
        if (telefono.value < 0 ||telefono.value == null || telefono.value == "" ) {
            error_telefono.removeAttribute('hidden')
            error_telefono.innerHTML = "TELEFONO VACIO";

        }else if (!telefono.value.match(/^\d+$/)) {
            error_telefono.removeAttribute('hidden')
            error_telefono.innerHTML = "SOLO SE PERMITEN NUMEROS";
        }else if (telefono.value.length > 12 || telefono.value.length < 7) {
            error_telefono.removeAttribute('hidden')
            error_telefono.innerHTML = "EL TELEFONO DEBE TENER MAXIMO 12 CARACTERES Y MINIMO 7";
        }
        else if (identificacion.value < 0 ||identificacion.value == null || identificacion.value == "" ) {
            error_identificacion.removeAttribute('hidden')
            error_identificacion.innerHTML = "NIT VACIO";
            error_telefono.setAttribute("hidden", "true");

        }else if(!identificacion.value.match(/^\d+$/)){
            error_identificacion.removeAttribute('hidden')
            error_identificacion.innerHTML = "SOLO SE PERMITEN NUMEROS";
            error_telefono.setAttribute("hidden", "true");
        }else if(identificacion.value.length > 15 || identificacion.value.length < 5){
            error_identificacion.removeAttribute('hidden')
            error_identificacion.innerHTML = "EL NIT DEBE SER MAYOR A 5 Y MENOR A 15 CARACTERES";
            error_telefono.setAttribute("hidden", "true");
        }

        else if (direccion.value == "") {
            error_direccion.removeAttribute('hidden')
            error_direccion.innerHTML = "DIRECCION VACIA";
            error_identificacion.setAttribute("hidden", "true");
            error_telefono.setAttribute("hidden", "true");
        } else if (ciudades.value == "") {
            error_ciudad.removeAttribute('hidden')
            error_ciudad.innerHTML = "ELIJA UNA CIUDAD";
            error_direccion.setAttribute("hidden", "true");
            error_identificacion.setAttribute("hidden", "true");
            error_telefono.setAttribute("hidden", "true");
        }else {
            error_ciudad.setAttribute("hidden", "true");
            try {
        $.ajax({
        type: 'POST',
        url: 'purchaseform/save_changes',
        data: {
            telefono: telefono.value,
            direccion: direccion.value,
            ciudad: ciudades.value,
            identificacion: identificacion.value,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
            finalizar_compra.remove();
            direccion.disabled = true;
            telefono.disabled = true;
            ciudades.disabled = true;
            identificacion.disabled = true;
            departamento.disabled = true;
            cargarPaypal();


        },
        error: function(error) {
            Swal.fire({
                icon: 'error',
                title: 'LO SIENTO',
                text: 'Hubo un error con sus datos'
            })
        }
    });
} catch (error) {

}

    }

})
departamentos.forEach(departamento => {

    departamento.addEventListener('change',function(){
        $.ajax({
            type: 'GET',
            url: 'purchase/ciudades/'+departamento.value,
            success: function(response) {
                // Manejar la respuesta del controlador si es necesario
                ciudades.innerHTML = "<option value=''>SELECCIONE UNA CIUDAD</option>";

                response['ciudades'].forEach(ciudad => {
                    ciudades.innerHTML = ciudades.innerHTML + "<option value='"+ciudad['id']+"'>"+ciudad['ciudades']+"</option>"
                });


            },
            error: function(error) {
                // Manejar el error si lo hay
                console.error(error);
            }
        });

    })
});


