jQuery('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  navText: ['<a class="carousel-control-prev"  role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>',
    '<a class="carousel-control-next"  role="button" data-slide="next"><span class="carousel-control-next-icon"aria-hidden="true"></span></a>'
  ],
  nav: true,
  responsive: {
    0: {
      items: 1
    },
    600: {
      items: 3,
    },
    1000: {
      items: 5,
    },
    1200: {
      items: 8,
    }
  }
});

/*jQuery('.owl-carousel').owlCarousel({
  loop: true,
  margin: 10,
  navText: ['<a class="carousel-control-prev"  role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span></a>',
    '<a class="carousel-control-next"  role="button" data-slide="next"><span class="carousel-control-next-icon"aria-hidden="true"></span></a>'
  ],
  responsiveClass: true,
  responsive: {
    0: {
      items: 1,
      nav: true
    },
    600: {
      items: 3,
      nav: false
    },
    1000: {
      items: 5,
      nav: true,
      loop: false
    }
  }
});*/