// vamos a obtener los botones de editar y cancelar para poder modificar la informacion de usuario
const editButtons = document.querySelectorAll('.editButton');
const cancelButtons = document.querySelectorAll('.cancelButton');

// aqui aparece el formulario para editar
editButtons.forEach((editButton, index) => {
    editButton.addEventListener('click', () => {
        const targetProfile = editButton.closest('.target-profile');
        const readView = targetProfile.querySelector('.readView');
        const editView = targetProfile.querySelector('.editView');

        readView.style.display = 'none';
        editView.style.display = 'block';
        editButton.style.display = 'none';
    });
});

// esto oculta el formulario y vuelve a mostrar la informacion
cancelButtons.forEach((cancelButton, index) => {
    cancelButton.addEventListener('click', () => {
        const targetProfile = cancelButton.closest('.target-profile');
        const readView = targetProfile.querySelector('.readView');
        const editView = targetProfile.querySelector('.editView');
        const editButton = targetProfile.querySelector('.editButton');

        readView.style.display = 'block';
        editView.style.display = 'none';
        editButton.style.display = 'block';
    });
});

 // Variable para llevar un registro del estado del botón


 function detenerBoton(e) {

     e.preventDefault();

   // Muestra una confirmación con SweetAlert
   Swal.fire({
     title: "¿Deseas continuar?",
     icon: "question",
     showCancelButton: true,
     confirmButtonText: "Sí",
     cancelButtonText: "No",
   }).then((result) => {
     if (result.isConfirmed) {
       // Cambia el estado del botón para permitir futuros clics
       document.querySelector('.btn-delete').closest('form').submit();
       // Aquí puedes agregar cualquier otra lógica que desees después de la confirmación
     }
   });
 }

 // Agrega un evento click al botón
 document.querySelector('.btn-delete').addEventListener("click", detenerBoton);

