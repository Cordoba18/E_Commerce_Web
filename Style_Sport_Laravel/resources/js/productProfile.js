document.addEventListener("DOMContentLoaded", function () {
    var selectTalla = document.getElementById("selectTalla");
    var inputCantidad = document.querySelector("input[name='amount']");


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
