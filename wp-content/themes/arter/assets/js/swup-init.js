( function( $ ) {
    'use strict';

  // swup js
  const options = {
    containers: ["#swup", "#swupMenu"],
    animateHistoryBrowsing: true,
    plugins: [new SwupBodyClassPlugin()]
  };
  if ( $('#swup').length && $('#swupMenu').length ) {
    const swup = new Swup(options);
  }

  // reinit
  document.addEventListener("swup:contentReplaced", function() {

    /* menu custom link */
    $('.menu-item-type-custom').each(function () {
      $(this).find('> a').attr('data-no-swup', '');
    });

  	if ( $('body').hasClass('default--scrolling') ) {
  		$('html, body').animate({scrollTop : 0},0);
  	}

    /*add custom elementor css*/
    var body_classes = $('body').attr('class').split(' ');
    var page_class = '';
    var page_id = 0;

    for (var i=0; i<body_classes.length; i++) {
      if (body_classes[i].substring(0, 8) == "page-id-") {
        var page_class = body_classes[i];
        var page_id = parseInt(page_class.replace('page-id-', ''));
      } else if (body_classes[i].substring(0, 15) == "elementor-page-") {
        var page_class = body_classes[i];
        var page_id = parseInt(page_class.replace('elementor-page-', ''));
      }
    }
    var elementor_post_css_url = swup_url_data.url.replace('themes/arter', '') + 'uploads/elementor/css/post-'+page_id+'.css'

    if ( !$("#elementor-post-"+page_id+"-css").length ) {
      $('<link id="elementor-post-'+page_id+'-css" href="'+elementor_post_css_url+'" rel="stylesheet">').appendTo("head");
    }

    if ( ! $('body').hasClass('default--scrolling') ) {
      Scrollbar.use(OverscrollPlugin);
      var scrollbar = Scrollbar.init(document.querySelector('#scrollbar'), {
        damping: 0.05,
        renderByPixel: true,
        continuousScrolling: true,
      });
      var scrollbar2 = Scrollbar.init(document.querySelector('#scrollbar2'), {
        damping: 0.05,
        renderByPixel: true,
        continuousScrolling: true,
      });
    }

    /*
    Initialize portfolio items
    */
    if ( $('.art-grid').length ) {
      var $container = $('.art-grid');
      $container.imagesLoaded(function() {
        $container.isotope({
          filter: '*',
          itemSelector: '.art-grid-item',
          transitionDuration: '.6s',
        });
      });
    }

    $('.art-filter a').on('click', function() {
      $('.art-filter .art-current').removeClass('art-current');
      $(this).addClass('art-current');

      var selector = $(this).data('filter');
      $('.art-grid').isotope({
        filter: selector
      });
      return false;
    });

    anime({
      targets: '.art-counter-frame',
      opacity: [0, 1],
      duration: 800,
      delay: 300,
      easing: 'linear',
    });

    $('.art-counter').each(function() {
      $(this).prop('Counter', 0).animate({
        Counter: $(this).text()
      }, {
        duration: 2000,
        easing: 'linear',
        step: function(now) {
          $(this).text(Math.ceil(now));
        }
      });
    });

    // slider testimonials
    var swiper = new Swiper('.art-testimonial-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      speed: 1400,
      autoplay: false,
      autoplaySpeed: 5000,
      pagination: {
        el: '.art-testi-swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.art-testi-swiper-next',
        prevEl: '.art-testi-swiper-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        720: {
          slidesPerView: 1,
        },
        1200: {
          slidesPerView: 2,
        },
        1500: {
          slidesPerView: 2,
        },
      },
    });

	// slider clients
  var swiper = new Swiper('.art-clients-slider', {
    slidesPerView: 4,
    spaceBetween: 30,
    speed: 1400,
    autoplay: false,
    autoplaySpeed: 5000,
    pagination: {
      el: '.art-clients-swiper-pagination',
      clickable: true,
    },
    navigation: {
      nextEl: '.art-clients-swiper-next',
      prevEl: '.art-clients-swiper-prev',
    },
    breakpoints: {
      0: {
        slidesPerView: 1,
      },
      720: {
        slidesPerView: 2,
      },
      1200: {
        slidesPerView: 4,
      },
      1500: {
        slidesPerView: 4,
      },
    },
  });

    // slider works
    var swiper = new Swiper('.art-works-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      speed: 1400,
      autoplay: {
        delay: 4000,
      },
      autoplaySpeed: 5000,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.art-works-swiper-next',
        prevEl: '.art-works-swiper-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        720: {
          slidesPerView: 2,
        },
        1200: {
          slidesPerView: 2,
        },
        1500: {
          slidesPerView: 2,
        },
      },
    });

    // slider blog
    var swiper = new Swiper('.art-blog-slider', {
      slidesPerView: 3,
      spaceBetween: 30,
      speed: 1400,
      autoplay: {
        delay: 4000,
      },
      autoplaySpeed: 5000,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.art-blog-swiper-next',
        prevEl: '.art-blog-swiper-prev',
      },
      breakpoints: {
        0: {
          slidesPerView: 1,
        },
        720: {
          slidesPerView: 1,
        },
        1200: {
          slidesPerView: 3,
        },
        1500: {
          slidesPerView: 3,
        },
      },
    });

    /*
      Magnific Popups
    */
    if(/\.(?:jpg|jpeg|gif|png)$/i.test($('.wp-block-gallery .blocks-gallery-item:first a').attr('href'))){
      $('.wp-block-gallery a').magnificPopup({
        gallery: {
            enabled: true
        },
        type: 'image',
        closeOnContentClick: false,
        fixedContentPos: false,
        closeBtnInside: false,
        callbacks: {
          beforeOpen: function() {
            // just a hack that adds mfp-anim class to markup
             this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
             this.st.mainClass = 'mfp-zoom-in';
          }
        },
      });
    }
    $('[data-magnific-inline]').magnificPopup({
      type: 'inline',
      overflowY: 'auto',
      preloader: false,
      callbacks: {
        beforeOpen: function() {
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-image]').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      fixedContentPos: false,
      closeBtnInside: false,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    if (!$('body').hasClass('elementor-page')) {
      $("a").each(function(i, el) {
        var href_value = el.href;
        if (/\.(jpg|png|gif)$/.test(href_value)) {
           $(el).magnificPopup({
              type: 'image',
              closeOnContentClick: true,
              fixedContentPos: false,
              closeBtnInside: false,
              callbacks: {
                beforeOpen: function() {
                  // just a hack that adds mfp-anim class to markup
                   this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                   this.st.mainClass = 'mfp-zoom-in';
                }
              },
            });
        }
      });
    }
    $('[data-magnific-video]').magnificPopup({
      type: 'iframe',
      iframe: {
          patterns: {
              youtube_short: {
                index: 'youtu.be/',
                id: 'youtu.be/',
                src: 'https://www.youtube.com/embed/%id%?autoplay=1'
              }
          }
      },
      preloader: false,
      fixedContentPos: false,
      callbacks: {
        markupParse: function(template, values, item) {
          template.find('iframe').attr('allow', 'autoplay');
        },
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-music]').magnificPopup({
      type: 'iframe',
      preloader: false,
      fixedContentPos: false,
      closeBtnInside: true,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });
    $('[data-magnific-gallery]').magnificPopup({
      gallery: {
          enabled: true
      },
      type: 'image',
      closeOnContentClick: false,
      fixedContentPos: false,
      closeBtnInside: false,
      callbacks: {
        beforeOpen: function() {
          // just a hack that adds mfp-anim class to markup
           this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
           this.st.mainClass = 'mfp-zoom-in';
        }
      },
    });

    $('.current-menu-item a').clone().prependTo('.art-current-page');

    $('.menu-item a').on('click', function() {
      if ($(this).parent().hasClass('menu-item-has-children')) {
        $(this).parent().children('.sub-menu').toggleClass('art-active');
        if($(this).attr('href') != '' && $(this).attr('href') != '#' && $(this).attr('href') != '#.') {
          if ( $(this).parent().hasClass('opened') ) {
            $(this).parent().removeClass('opened');
          } else {
            $(this).parent().addClass('opened');
            return false;
          }
        } else {
          return false;
        }
      } else {
        $('.art-menu-bar-btn , .art-menu-bar , .art-info-bar , .art-content , .art-menu-bar-btn , .art-info-bar-btn').removeClass('art-active , art-disabled');
      }

      if ( $(this).attr('href') != '' && $(this).attr('href') != undefined ) {
        if ( $(this).attr('href').charAt(0) == "#" ) {
          var section_id = $(this).attr('href');

          if ( $(section_id).length && !$('body').hasClass('default--scrolling') ) {
            var section_top = scrollbar.scrollTop + $(section_id).offset().top - 30;
            scrollbar.scrollTo(0, section_top, 500);
          }
        }
      }
    });

  })
} )( jQuery );
