var corazonBotones = document.querySelectorAll('.icon-corazon');
var carritoBotones = document.querySelectorAll('.ico-carrito');

//Logica de Agregar Carrito---Pagina principal
carritoBotones.forEach(function (boton) {
  boton.addEventListener('click', function () {
    var cardBody = boton.closest('.card-body');
    var id = cardBody.querySelector('.id-product').value;
    var icon = cardBody.querySelector('.carrito');

    var accion = "agregar-carrito"

    const datos = {
      id: id,
      accion: accion,
    };

    const opciones = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datos)
    };

    fetch('BaseDatos/procesar.php', opciones)
      .then(function (response) {
        return response.text();
      })
      .then(function (respuesta) {
        console.log(respuesta);
        if (respuesta == "Se agrego") {
          const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
          })
          Toast.fire({
            icon: 'success',
            title: 'Agregado al carrito'
          })
        } else {
          const Toast2 = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 1000,
          })
          Toast2.fire({
            icon: 'warning',
            title: 'el producto ya esta en el carrito'
          })
        }
      })
      .catch(function (error) {
        console.error(error);
      });

    if (icon.classList.contains('cart-clear')) {
      icon.classList.add('cart-agg');
      icon.classList.remove('cart-clear');
    }
  })
})
// Logica de favoritos---Pagina principal
corazonBotones.forEach(function (boton) {
  boton.addEventListener('click', function () {
    var cardBody = boton.closest('.card-body');
    var id = cardBody.querySelector('.id-product').value;
    var icon = cardBody.querySelector('.corazon');

    var accion;

    if (icon.classList.contains('no-fav')) {
      icon.classList.add('fa-solid');
      icon.classList.remove('fa-regular');

      accion = "agregar";

      icon.classList.remove('no-fav');
      icon.classList.add('si-fav');
    } else {
      icon.classList.remove('fa-solid');
      icon.classList.add('fa-regular');

      accion = "eliminar";

      icon.classList.add('no-fav');
      icon.classList.remove('si-fav');
    }

    const datos = {
      id: id,
      accion: accion,
    };

    const opciones = {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(datos)
    };

    fetch('BaseDatos/procesar.php', opciones)
      .then(function (response) {
        return response.text();
      })
      .then(function (respuesta) {
        console.log(respuesta);
      })
      .catch(function (error) {
        console.error(error);
      });

    if (accion == "agregar") {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
      })
      Toast.fire({
        icon: 'success',
        title: 'Agregado a favoritos'
      })
    } else if (accion == "eliminar") {
      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 1000,
      })
      Toast.fire({
        icon: 'success',
        title: 'Eliminado de favoritos'
      })
    }
  });
});
