const button = document.querySelector('.button')
const button_inferior = document.querySelector('.button-inferior')

console.log('vengo de header.js')
button.addEventListener('click',()=>{
    const nav    = document.querySelector('.nav')
    nav.classList.toggle('activo')
})

button_inferior.addEventListener('click', () =>{
    const nav_infer = document.querySelector('.nav-inf')
    nav_infer.classList.toggle('activo')
})