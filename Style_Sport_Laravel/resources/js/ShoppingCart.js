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
        let id_carrito = product.querySelector("#id_carrito").innerHTML;
        if (btn_accion.textContent === "ELIMINAR") {
            Swal.fire({
                icon: 'error',
                title: 'PRODUCTO ELIMINADO',
                text: 'VERIFIQUE SU TABLA',
              })
              $.ajax({
                url: "shoppingcart/delete/"+id_carrito+"",
              },

              )
        }else{
            if (btn_accion.textContent === "SELECCIONAR") {
                btn_accion.textContent = "CANCELAR"
            }else{
                btn_accion.textContent = "SELECCIONAR"
        }
    }
    })


} );
