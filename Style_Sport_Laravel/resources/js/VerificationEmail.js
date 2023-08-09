


let datos =  document.querySelector('#datos').innerHTML;
let btn_siguiente = document.querySelector("#btn_siguiente");
if (datos == "") {

    alert("LO SIENTO! Algo estuvo mal. Vuelve a intentarlo");
    window.location.href = "register_Inicio";



}
const dataArray = datos.split('%');
const verificationCode = dataArray[2];
let correo = document.querySelector("#correo");
correo.innerHTML = verificationCode;


btn_siguiente.addEventListener("click", () => {

    let codigo = document.querySelector("#codigo").value;
    const _token = document.querySelector("input[name=_token]").value;

    $.ajax({
        type: "POST",
        url: "verification_code",
        data:{
            correo:verificationCode,
            nombre:dataArray[0] +" "+ dataArray[1],
            contrasena:dataArray[3],
            f_nacimiento:dataArray[4],
            codigo:codigo,
            _token: _token,
        },
        success: function(response) {

            if (response['message'] == true) {

                Swal.fire(
                    'CUENTA CREADA',
                     'Ya eres parte de nosotros',
                     'success'
                    )
                setTimeout(() => {

                    window.location.href = "login_inicio";
                }, 2000);


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
        url: "delete/code/" +verificationCode+"",
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
           alert('CODIGO ELIMINADO');
           window.location.href = "register_Inicio";

        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });

    }, 300000);





