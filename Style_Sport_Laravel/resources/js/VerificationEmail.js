
let datos =  document.querySelector('#datos').innerHTML;
const dataArray = datos.split('%');
const verificationCode = dataArray[2];
    setTimeout(() => {

        $.ajax({
        type: "GET",
        url: "delete/code/" +verificationCode+"",
        success: function(response) {
            // Manejar la respuesta del controlador si es necesario
           alert('CODIGO ELIMINADO');

        },
        error: function(error) {
            // Manejar el error si lo hay
            console.error(error);
        }
    });

    }, 10000);
