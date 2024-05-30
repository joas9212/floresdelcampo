import '@jquery'
import '@slick'
import '@slick_scss'
import '@slick_theme_scss'


$(window).on("scroll",function() {
    if ($(this).scrollTop() > 100) { 
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
  });

  $(function() {
    console.log('jQuery está funcionando!');
    $('.slider-main').slick({
      lazyLoad: 'ondemand',
      slidesToShow: 1,
      slidesToScroll: 1, 
      autoplay: true,
      pauseOnFocus: false,
      pauseOnHover: false,
      autoplaySpeed: 5000,
      dots: false,
      arrows: false,
    });
});