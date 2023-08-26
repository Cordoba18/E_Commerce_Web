document.addEventListener("DOMContentLoaded", function () {
    var selectTalla = document.getElementById("selectTalla");
    var inputCantidad = document.querySelector("input[name='amount']");

    inputCantidad.addEventListener('keydown', (event) => {
        event.preventDefault();
      });

    selectTalla.addEventListener("change", function () {
        var selectedOption = selectTalla.options[selectTalla.selectedIndex];
        var maxCantidad = selectedOption.getAttribute("data-cantidad");
        inputCantidad.max = maxCantidad;
        inputCantidad.value = 1;
        inputCantidad.min = 1;
    });

    var btnPlus = document.querySelector(".plus");
    var btnLess = document.querySelector(".less");


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



btn_calificar.addEventListener("click", function () {

    contenedor_estrellas.innerHTML = "<div style='transition: 2s' class='contenedor_estrellas_1'> "+
                    "<div class='contenedor_estrellas_2'>"+
                    "<i class='fa-solid fa-x btn_x'></i>"+
                    "<h1>CALIFICANOS</h1>"+
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

    let btn_x = document.querySelector(".btn_x");
    const estrellas = document.querySelectorAll("input[name=estrellas]");
    let btn_confirmar_calificacion = document.querySelector(".btn_confirmar_calificacion");
    accion_btn_x(btn_x);
    accion_estrellas(estrellas);
    accion_calificar(btn_confirmar_calificacion);

})


function accion_btn_x(btn_x) {

    btn_x.addEventListener("click", function () {
        contenedor_estrellas.innerHTML="";
    })
}
let valor_estrella = "";

function accion_estrellas(estrellas) {
    estrellas.forEach(estrella => {
        estrella.addEventListener("click", function () {
            valor_estrella = estrella.value;
            console.log(valor_estrella);

        })
    });
}
function accion_calificar(btn_confirmar_calificacion) {
let id_producto = document.querySelector("input[name=product]").value;
const _token = document.querySelector("input[name=_token]").value;
btn_confirmar_calificacion.addEventListener("click", function () {
if (valor_estrella == "") {

    Swal.fire({
        icon: 'error',
        title: 'ELIJA UNA CALIFICACION',
        text: 'Debes elegir una calificacion para poder continuar'
    })
} else {

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

