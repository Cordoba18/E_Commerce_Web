// vamos a seleccionar las talllas y validar que no se vulnere el input
document.addEventListener("DOMContentLoaded", function () {
    var selectTalla = document.getElementById("selectTalla");
    var inputCantidad = document.querySelector("input[name='amount']");

    //prevenimos que se pueda escribir en el input
    inputCantidad.addEventListener('keydown', (event) => {
        event.preventDefault();
      });

      // se hace el cambio de talla
    selectTalla.addEventListener("change", function () {
        var selectedOption = selectTalla.options[selectTalla.selectedIndex];
        var maxCantidad = selectedOption.getAttribute("data-cantidad");
        inputCantidad.max = maxCantidad;
        inputCantidad.value = 1;
        inputCantidad.min = 1;
    });

    var btnPlus = document.querySelector(".plus");
    var btnLess = document.querySelector(".less");

// para sumar cantidad o disminuir la cantidad
    btnPlus.addEventListener("click", function () {
        var currentValue = parseInt(inputCantidad.value);
        var maxValue = parseInt(inputCantidad.max);
        if (currentValue < maxValue) {
            inputCantidad.value = currentValue + 1;
        }
    });

    btnLess.addEventListener("click", function () {
        var currentValue = parseInt(inputCantidad.value);
        if (currentValue > 1 ) {
            inputCantidad.value = currentValue - 1;
        }
    });
});


let btn_calificar = document.querySelector('#btn_calificar');
let contenedor_estrellas =  document.querySelector("#contenedor_estrellas");


//accion boton de "calificar"
btn_calificar.addEventListener("click", function () {
//inserto la informacion en el elemento para mostrar la ventana de calificacion
    contenedor_estrellas.innerHTML = "<div style='transition: 2s' class='contenedor_estrellas_1'> "+
                    "<div class='contenedor_estrellas_2'>"+
                    "<i class='fa-solid fa-x btn_x'></i>"+
                    "<h1>CALIFÌCANOS</h1>"+
                    "<div class='valoracion'>"+
                    "<input id='radio1' type='radio' name='estrellas' value='5'>"+
                    "<label for='radio1'>★</label>"+
                    "<input id='radio2' type='radio' name='estrellas' value='4'>"+
                    "<label for='radio2'>★</label>"+
                    "<input id='radio3' type='radio' name='estrellas' value='3'>"+
                    "<label for='radio3'>★</label>"+
                    "<input id='radio4' type='radio' name='estrellas' value='2'>"+
                    "<label for='radio4'>★</label>"+
                    "<input id='radio5' type='radio' name='estrellas' value='1'>"+
                    "<label for='radio5'>★</label>"+
                  "</div><br>" +
                  "<button class='btn_confirmar_calificacion btn btn-primary'>CALIFICAR</button></div></div>";
//captura del boton para cerrar ventana
    let btn_x = document.querySelector(".btn_x");
    //captura de todas las estrellas
    const estrellas = document.querySelectorAll("input[name=estrellas]");
    //captura elemento para finalizar calificacion
    let btn_confirmar_calificacion = document.querySelector(".btn_confirmar_calificacion");
   //llamada de metodos
    accion_btn_x(btn_x);
    accion_estrellas(estrellas);
    accion_calificar(btn_confirmar_calificacion);

})


function accion_btn_x(btn_x) {
    //cerrar ventana
    btn_x.addEventListener("click", function () {
        contenedor_estrellas.innerHTML="";
    })
}
let valor_estrella = "";

function accion_estrellas(estrellas) {
    //recorrer estrellas para llenar variable con su valor cuando se seleccione
    estrellas.forEach(estrella => {
        estrella.addEventListener("click", function () {
            valor_estrella = estrella.value;

        })
    });
}
function accion_calificar(btn_confirmar_calificacion) {
let id_producto = document.querySelector("input[name=product]").value;
const _token = document.querySelector("input[name=_token]").value;
btn_confirmar_calificacion.addEventListener("click", function () {
    //validacion para que exista un valor de calificacion seleccionado
if (valor_estrella == "") {

    Swal.fire({
        icon: 'error',
        title: 'ELIJA UNA CALIFICACION',
        text: 'Debes elegir una calificacion para poder continuar'
    })
} else {

    //calificar
$.ajax({
    url: "calificar",
    type: "POST",
    data:{
        id_producto: id_producto,
        valoracion: valor_estrella,
        _token: _token,
    },success: function(response) {
        if (response['message'] === true) {
            contenedor_estrellas.innerHTML="";
            Swal.fire(
                'PRODUCTO CALIFICADO',
                 'Gracias por darnos tu opinion',
                 'success'
                )
                setTimeout(() => {
            window.location.href = id_producto;
        }, 2000);
        }else {
            Swal.fire({
                icon: 'error',
                title: 'NO ESTAS LOGUEADO',
                text: 'Debes estar logueado para calificar'
            })
        }

    },
    error: function(error) {
        console.error(error);
    }
  },
  )

}
})
}

