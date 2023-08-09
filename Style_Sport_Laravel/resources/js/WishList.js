let productos = document.querySelectorAll("#productos");



productos.forEach(element => {

    let btn_eliminar = element.querySelector("#btn_eliminar");
    let id_lista_deseos = element.querySelector("#id_lista_deseos").innerHTML;
    btn_eliminar.addEventListener("click", () => {

        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'PRODUCTO ELIMINADO DE LA LISTA',
            showConfirmButton: false,
            timer: 1500
          })
          $.ajax({
            url: "wishlist/delete/"+id_lista_deseos+"",
          },

          )
          element.remove();

    })
});
