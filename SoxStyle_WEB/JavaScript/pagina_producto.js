const inputQuantity = document.querySelector('.input-quantity')
const btnIncrement = document.querySelector('#Increment')
const btnDecrement = document.querySelector('#Decrement')

let valuebyDefault = parseInt(inputQuantity.value)

//funciones
btnIncrement.addEventListener('click', ()=>{
    
    let placeholder = parseInt(inputQuantity.getAttribute('placeholder'))
    placeholder = placeholder + 1
    inputQuantity.removeAttribute('placeholder')
    inputQuantity.setAttribute('placeholder',  placeholder)

})

btnDecrement.addEventListener('click', ()=>{
    let placeholder = parseInt(inputQuantity.getAttribute('placeholder'))
    if (placeholder == 0) {
        
    }else{
    let placeholder = parseInt(inputQuantity.getAttribute('placeholder'))
    placeholder = placeholder - 1
    inputQuantity.removeAttribute('placeholder')
    inputQuantity.setAttribute('placeholder',  placeholder)}
})


//toggle

//constantes
const ToggleDescription = document.querySelector('.title-description')
const ToggleAdditionalInformation = document.querySelector('.title-additional-information')
const ToggleReviews = document.querySelector('.title-reviews')

//constantes contenido texto
const contentdescription = document.querySelector('.text-description')
const contentadditionalinformation = document.querySelector('.text-additional-information')
const contentreviews = document.querySelector('.text-reviews')

//funciones toggle
ToggleDescription.addEventListener('click', ()=>{
    contentdescription.classList.toggle('hidden');
}); 

ToggleAdditionalInformation.addEventListener('click', ()=>{
    contentadditionalinformation.classList.toggle('hidden');
}); 

ToggleReviews.addEventListener('click', ()=>{
    contentreviews.classList.toggle('hidden');
}); 