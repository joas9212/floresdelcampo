import '@jquery'
import '@slick'
import '@slick_scss'
import '@slick_theme_scss'


$(window).on("scroll",function() {
    if ($(this).scrollTop() > 100) { // puedes cambiar el valor 100 a la altura que prefieras
      $('#website_header_cart_sticky_contain').css({
        'opacity': '1',
        'visibility': 'visible'
      });
    } else {
      $('#website_header_cart_sticky_contain').css({
        'opacity': '0',
        'visibility': 'hidden'
      });
    }

    $('.slider-main').slick({
        lazyLoad: 'ondemand',
        slidesToShow: 1,
        slidesToScroll: 1, 
        autoplay: true,
        pauseOnFocus: false,
        pauseOnHover: false,
        autoplaySpeed: 5000,
      });
  });