// const swiper = new Swiper('.swiper', {
// loop: true,
// pagination: {
//     el: '.swiper-pagination',
//     clickable: true,
//     dynamicBullets: true,
// },
// navigation: {
//     nextEl: '.swiper-button-next',
//     prevEl: '.swiper-button-prev',
// },
// autoplay: {
//     delay: 5000,
//     pauseOnMouseEnter: true,

// },
// scrollbar: false,
// });


var TrandingSlider = new Swiper('.tranding-slider', {
    effect: 'coverflow',
    grabCursor: false,
    centeredSlides: true,
    loop: true,
    slidesPerView: 'auto',
    coverflowEffect: {
      rotate: 0,
      stretch: 0,
      depth: 100,
      modifier: 2.5,
    },
    autoplay: {
      delay: 2000, // El valor es en milisegundos (5 segundos en este ejemplo)
      disableOnInteraction: false, // Esto permite que el carrusel siga reproduciéndose incluso si el usuario interactúa con él
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    }
  });
