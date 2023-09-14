const button = document.querySelector('.button-responsive')

// aqui hacemos que el navbar aparezca y desaparezca cada vez que se presione

button.addEventListener('click',()=>{
    const nav    = document.querySelector('.columntwo')
    nav.classList.toggle('active')
})
