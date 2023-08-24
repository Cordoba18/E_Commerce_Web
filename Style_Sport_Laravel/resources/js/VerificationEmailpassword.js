


let email =  document.querySelector('#email').innerHTML;
let correo =  document.querySelector('#correo');
let btn_siguiente = document.querySelector("#btn_siguiente");
if (email == "") {

    alert("LO SIENTO! Algo estuvo mal. Vuelve a intentarlo");
    window.location.href = "recoverpassword";

}


correo.innerHTML = email;



btn_siguiente.addEventListener("click", () => {
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
                    'CUENTA CREADA',
                     'CODIGO CORRECTO',
                     'success'
                    )
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
    setTimeout(() => {

        $.ajax({
        type: "GET",
        url: "/delete/code/" +email+"",
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
           alert('CODIGO ELIMINADO');
           window.location.href = "recoverpassword";

        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });

    }, 3000);





