const button = document.querySelector('.button-responsive')

console.log(button)

button.addEventListener('click',()=>{
    const nav    = document.querySelector('.columntwo')
    nav.classList.toggle('active')
})
