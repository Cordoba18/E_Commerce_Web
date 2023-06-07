window.addEventListener('load', function () {
  new Glider(document.querySelector('.carousel-listaD'), {
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: '.carousel-indicadoresD',
    arrows: {
      prev: '.carousel-anteriorD',
      next: '.carousel-siguienteD'
    },
    responsive: [
      {
        // screens greater than >= 775px
        breakpoint: 800,
        settings: {
          // Set to `auto` and provide item width to adjust to viewport
          slidesToShow: '2',
          slidesToScroll: '2',
          itemWidth: 150,
          duration: 0.25
        }
      }, {
        // screens greater than >= 1024px
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          itemWidth: 150,
          duration: 0.25
        }
      }
    ]

  });
});
window.addEventListener('load', function () {
  new Glider(document.querySelector('.carousel-listaN'), {
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: '.carousel-indicadoresN',
    arrows: {
      prev: '.carousel-anteriorN',
      next: '.carousel-siguienteN'
    },
    responsive: [
      {
        // screens greater than >= 775px
        breakpoint: 800,
        settings: {
          // Set to `auto` and provide item width to adjust to viewport
          slidesToShow: '2',
          slidesToScroll: '2',
          itemWidth: 150,
          duration: 0.25
        }
      }, {
        // screens greater than >= 1024px
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          itemWidth: 150,
          duration: 0.25
        }
      }
    ]

  });
});
window.addEventListener('load', function () {
  new Glider(document.querySelector('.carousel-listaF'), {
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: '.carousel-indicadoresF',
    arrows: {
      prev: '.carousel-anteriorF',
      next: '.carousel-siguienteF'
    },
    responsive: [
      {
        // screens greater than >= 775px
        breakpoint: 800,
        settings: {
          // Set to `auto` and provide item width to adjust to viewport
          slidesToShow: '2',
          slidesToScroll: '2',
          itemWidth: 150,
          duration: 0.25
        }
      }, {
        // screens greater than >= 1024px
        breakpoint: 1024,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4,
          itemWidth: 150,
          duration: 0.25
        }
      }
    ]

  });
});
