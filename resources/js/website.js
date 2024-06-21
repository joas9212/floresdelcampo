import '@jquery'
import '@slick'
import '@slick_scss'
import '@slick_theme_scss'


  $(function() {
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

    function handleScroll() {
      if ($(this).scrollTop() > 100) { 
          $('#website_header_cart_sticky_contain').css({
              'opacity': '1',
              'visibility': 'visible'
          });
          $('#bg-white-fullwidth').css({
              'opacity': '1',
              'visibility': 'visible'
          });
          if (!$('.menu-background').hasClass('show')) {
              $('#menu-toggle svg').css('stroke', '#000000');
          }
      } else {
          $('#website_header_cart_sticky_contain').css({
              'opacity': '0',
              'visibility': 'hidden'
          });
          $('#bg-white-fullwidth').css({
              'opacity': '0',
              'visibility': 'hidden'
          });
          if (!$('.menu-background').hasClass('show')) {
              $('#menu-toggle svg').css('stroke', '#ffffff');
          }
      }
    }

    // Función para manejar el clic del menú
    function handleMenuClick() {
        const menu = document.querySelector('nav ul');
        const menuBackground = document.querySelector('.menu-background');
    
        menu.classList.toggle('show');
        menuBackground.classList.toggle('show');
    
        if (menuBackground.classList.contains('show')) {
            $('#menu-toggle svg').css('stroke', '#000000');
        } else {
            if ($(window).scrollTop() <= 100) {
                $('#menu-toggle svg').css('stroke', '#ffffff');
            }
        }
    }

    // Asignar eventos
    $(window).on('scroll', handleScroll);
    $('#menu-toggle').on('click', handleMenuClick);

    // Inicializar la función de scroll para ajustar los estilos al cargar la página
    handleScroll.call(window);
});