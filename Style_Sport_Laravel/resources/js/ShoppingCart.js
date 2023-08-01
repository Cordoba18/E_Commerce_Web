const btn_comprar = document.querySelector('#btn_comprar');
const producto_carrito = document.querySelectorAll("#producto_carrito");

let accion_boton = false;
btn_comprar.addEventListener("click", function(){

    producto_carrito.forEach(product => {
        let btn_accion = product.querySelector("#btn_accion");
        if (accion_boton === false) {
        btn_accion.textContent = "SELECCIONAR";
        btn_comprar.textContent = "CANCELAR";
        }
        else{
            btn_accion.textContent = "ELIMINAR";
            btn_comprar.textContent = "COMPRAR";
        }

    });
    if (accion_boton === false) {
        accion_boton = true;
    }else{
        accion_boton = false;
    }
});

let user = document.querySelector("#user").innerHTML;
producto_carrito.forEach(product => {
    let btn_accion = product.querySelector("#btn_accion");
    btn_accion.addEventListener("click", function(){
        if (btn_accion.textContent === "ELIMINAR") {
            Swal.fire({
                icon: 'error',
                title: 'PRODUCTO ELIMINADO',
                text: 'VERIFIQUE SU TABLA',
              })

        }else{
            if (btn_accion.textContent === "SELECCIONAR") {
                btn_accion.textContent = "CANCELAR"
                let id_producto = product.querySelector("#id_producto").innerHTML;
            }else{
                btn_accion.textContent = "SELECCIONAR"
        }
    }
    })


} );
