const btn_comprar = document.querySelector('#btn_comprar');
const producto_carrito = document.querySelectorAll("#producto_carrito");
const total_full = document.querySelector("#total_full");
let accion_boton = false;
let contenedor_btn_comprar = document.querySelector("#contenedor_btn_comprar");
btn_comprar.addEventListener("click", function(){

    producto_carrito.forEach(product => {
        let btn_accion = product.querySelector("#btn_accion");
        if (accion_boton === false) {
            Swal.fire('SELECCIONE LOS PRODUCTOS A COMPRAR')
        btn_accion.textContent = "SELECCIONAR";
        btn_comprar.textContent = "CANCELAR";
        contenedor_btn_comprar.removeAttribute('hidden');

        }
        else{
            btn_accion.textContent = "ELIMINAR";
            btn_comprar.textContent = "COMPRAR";
           contenedor_btn_comprar.setAttribute('hidden', 'true');
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
    let id_carrito = product.querySelector("#id_carrito").innerHTML;
    let btn_accion = product.querySelector("#btn_accion");
    let seleccion_cantidad = product.querySelector("#seleccion_cantidad");

    seleccion_cantidad.addEventListener('change', function() {
        let cantidad = parseInt(product.querySelector("#cantidad").innerHTML);
        const total = parseFloat(product.querySelector("#total").innerHTML);
        total_full.innerHTML = parseFloat(total_full.innerHTML) - (cantidad*total);

        const valorSeleccionado = seleccion_cantidad.value;
        const _token = product.querySelector("input[name=_token]").value;

        $.ajax({
            url: "shoppingcart/editquantity",
            type: "POST",
            data:{
                cantidad: valorSeleccionado,
                id: id_carrito,
                _token: _token,
            },
          },
          )
          let cambiar_cantidad = product.querySelector("#cantidad");
          cambiar_cantidad.innerHTML = valorSeleccionado;
          total_full.innerHTML = parseFloat(total_full.innerHTML) + (valorSeleccionado*total);
    })




    btn_accion.addEventListener("click", function(){
        if (btn_accion.textContent === "ELIMINAR") {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'PRODUCTO ELIMINADO DEL CARRITO',
                showConfirmButton: false,
                timer: 1500
              })
              $.ajax({
                url: "shoppingcart/delete/"+id_carrito+"",
              },

              )
              product.remove();
              let cantidad = parseInt(product.querySelector("#cantidad").innerHTML);
              let total = parseFloat(product.querySelector("#total").innerHTML);
              total_full.innerHTML = parseFloat(total_full.innerHTML) - (cantidad*total);

        }else{
            if (btn_accion.textContent === "SELECCIONAR") {
                btn_accion.textContent = "CANCELAR"
                $.ajax({
                    url: "shoppingcart/seleccionar/"+id_carrito+"",
                  },

                  )

            }else{
                btn_accion.textContent = "SELECCIONAR"
                $.ajax({
                    url: "shoppingcart/cancelar_seleccion/"+id_carrito+"",
                  },
                  )
        }
    }
    })


} );
