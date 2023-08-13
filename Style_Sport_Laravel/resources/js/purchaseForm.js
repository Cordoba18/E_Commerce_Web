let finalizar_compra = document.querySelector("#finalizar_compra");
let departamentos = document.querySelectorAll('#departamentos');
let ciudades = document.querySelector('#ciudades');



finalizar_compra.addEventListener("click", function(e){

    let departamento = document.querySelector('#departamentos');
    let error_telefono = document.querySelector("#error_telefono");
    let error_direccion = document.querySelector("#error_direccion");
    let contenedor_inputs = document.querySelector(".contenedor_inputs");
    let error_ciudad = document.querySelector("#error_ciudad");
        let telefono = document.querySelector('#telefono');
        let direccion = document.querySelector('#direccion');
        if (telefono.value < 0 ||telefono.value == null || telefono.value == "" ) {
            error_telefono.removeAttribute('hidden')
            error_telefono.innerHTML = "TELEFONO VACIO";

        }
        else if (direccion.value == "") {
            error_direccion.removeAttribute('hidden')
            error_direccion.innerHTML = "DIRECCION VACIA";
            error_telefono.setAttribute("hidden", "true");
        } else if (ciudades.value == "") {
            error_ciudad.removeAttribute('hidden')
            error_ciudad.innerHTML = "ELIJA UNA CIUDAD";
            error_direccion.setAttribute("hidden", "true");
        }else {
            error_ciudad.setAttribute("hidden", "true");
            try {
        finalizar_compra.remove();
        direccion.disabled = true;
        telefono.disabled = true;
        ciudades.disabled = true;
        departamento.disabled = true;
        cargarPaypal();
        $.ajax({
        type: 'POST',
        url: 'purchaseform/save_changes',
        data: {
            telefono: telefono.value,
            direccion: direccion.value,
            ciudad: ciudades.value,
            _token: _token // Enviar los datos devueltos por la API de PayPal
        },
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario


        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });
} catch (error) {
    console.log(error);
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


