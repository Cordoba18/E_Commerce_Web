const btn_comprar = document.querySelector('#btn_comprar');
const producto_carrito = document.querySelectorAll("#producto_carrito");
const total_full = document.querySelector("#total_full");
let accion_boton = false;
let contenedor_btn_comprar = document.querySelector("#contenedor_btn_comprar");
//manejar el cambio de seleccion previo a ir a comprar
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
//Se edita la cantidad utilizando ajax y se calcula el total para ser mostrado rapidamente
producto_carrito.forEach(product => {
    let id_carrito = product.querySelector("#id_carrito").innerHTML;
    let btn_accion = product.querySelector("#btn_accion");
    let seleccion_cantidad = product.querySelector("#seleccion_cantidad");

    seleccion_cantidad.addEventListener('change', function() {
        let cantidad = parseInt(product.querySelector("#cantidad").innerHTML);
        const total = parseFloat(product.querySelector("#total").innerHTML);

        const valorSeleccionado = seleccion_cantidad.value;
        const _token = product.querySelector("input[name=_token]").value;
        let tallas_id = product.querySelector("#tallas_id").innerHTML;
        $.ajax({
            url: "shoppingcart/editquantity",
            type: "POST",
            data:{
                cantidad: valorSeleccionado,
                id: id_carrito,
                tallas_id: tallas_id,
                _token: _token,
            },success: function(response) {
              if (response['message'] === true) {
                calcular_carrito();
                let timerInterval
                Swal.fire({
                  title: 'CALCULANDO',
                  html: 'Estamos calculando tu total <b></b> milliseconds.',
                  timer: 1500,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                  }
                })

                setTimeout(() => {
                total_full.innerHTML = total_calculo;
            }, 2000);
              } else {
                Swal.fire({
                    icon: 'error',
                    title: 'OPPS CANTIDAD INCORRECTA',
                    text: 'Esa cantidad ya no esta disponible !Actualiza el carrito!'
                })
              }
            },
            error: function(error) {
                console.error(error);
            }
          },
          )
    })

//funcion que va a un ruta y obtiene el total del carrito y lo llena en una variable
    var total_calculo = "";
    function calcular_carrito() {
        total_calculo = "";
        $.ajax({
            url: "shoppingcart/calcular",
            type: "GET",
            success: function(response) {
                total_calculo = response['message'];
            },
            error: function(error) {
                console.error(error);
            }
          },
          )
    }
    //accion que elimina, selecciona o desseleciona un producto del carrito
    btn_accion.addEventListener("click", function(){
        //eliminar producto del carrito de compras
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
              calcular_carrito();
                let timerInterval
                Swal.fire({
                  title: 'CALCULANDO',
                  html: 'Estamos calculando tu total <b></b> milliseconds.',
                  timer: 1500,
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                      b.textContent = Swal.getTimerLeft()
                    }, 100)
                  },
                  willClose: () => {
                    clearInterval(timerInterval)
                  }
                }).then((result) => {
                  /* Read more about handling dismissals below */
                  if (result.dismiss === Swal.DismissReason.timer) {
                  }
                })

                setTimeout(() => {
                total_full.innerHTML = total_calculo;
            }, 2000);

        }else{
                    //seleccionar producto del carrito de compras
            if (btn_accion.textContent === "SELECCIONAR") {
                btn_accion.textContent = "CANCELAR"
                $.ajax({
                    url: "shoppingcart/seleccionar/"+id_carrito+"",
                    success: function(response) {
                        if (response['message'] === false) {
                            Swal.fire({
                                icon: 'error',
                                title: 'LO SIENTO',
                                text: 'Ese producto ha sido previamente eliminado'
                            })
                            window.location.href = "shoppingcart";
                        }
                    }
                  },

                  )

            }else{
                        //cancelar seleccion de producto del carrito de compras
                btn_accion.textContent = "SELECCIONAR"
                $.ajax({
                    url: "shoppingcart/cancelar_seleccion/"+id_carrito+"",
                    success: function(response) {
                        if (response['message'] === false) {
                            Swal.fire({
                                icon: 'error',
                                title: 'LO SIENTO',
                                text: 'Ese producto ha sido previamente eliminado'
                            })
                            window.location.href = "shoppingcart";
                        }
                    }
                },
                  )
        }
    }
    })


} );
