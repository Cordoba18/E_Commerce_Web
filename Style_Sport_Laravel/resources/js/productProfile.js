document.addEventListener("DOMContentLoaded", function () {
    var selectTalla = document.getElementById("selectTalla");
    var inputCantidad = document.querySelector("input[name='amount']");
    
    inputCantidad.disabled = true;
   
    // Manejar el evento de cambio en el select
    selectTalla.addEventListener("change", function () {
        var selectedOption = selectTalla.options[selectTalla.selectedIndex];
        var maxCantidad = selectedOption.getAttribute("data-cantidad");
        inputCantidad.max = maxCantidad;
        inputCantidad.value = 1;
        inputCantidad.min = 1;
         // Reiniciar el valor del input a 0 cuando cambia la talla
    });

    // Manejar los botones de incremento y decremento de la cantidad
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