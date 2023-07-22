window.addEventListener('load', function () {
    new Glider(document.querySelector('.carousel-listaD'), {
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: {
        prev: '.carousel-anteriorD',
        next: '.carousel-siguienteD'
      },
      responsive: [
        {
          // screens greater than >= 775px
          breakpoint: 540,
          settings: {
            // Set to `auto` and provide item width to adjust to viewport
            slidesToShow: 2,
            slidesToScroll: 2,
            duration: 0.25
          }
        }, {
          // screens greater than >= 1024px
          breakpoint: 800,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            duration: 0.25
          }
        }, {
          // screens greater than >= 1024px
          breakpoint: 1250,
          settings: {
            slidesToShow: 4,
            slidesToScroll: 4,
            duration: 0.25
          }
        }, {
          // screens greater than >= 1024px
          breakpoint: 1450,
          settings: {
            slidesToShow: 5,
            slidesToScroll: 5,
            duration: 0.25
          }
        }
      ]
  
    });
  });