jQuery(document).ready(function($) {

  $('#sliderBeforeAfter').slick({
      dots: false,
      arrows: true,
      infinite: true,
      speed: 1000,
      variableWidth: true,
      autoplay: false,
      pauseOnHover: false,
      autoplaySpeed: 8000,
      slidesToShow: 1,
      swipeToSlide: false,
      swipe: false
      });
      
      $(".deslizador").on ({
      change: function() {
      console.log( "change", $(this).val() );
      $(this).prev().find(".separador").css("width", $(this).val()+"%");
      },
      input: function() {
      console.log( "change", $(this).val() );
      $(this).prev().find(".separador").css("width", $(this).val()+"%");
      },
      });
      var divisor = document.getElementsByClassName("separador"),
      slider = document.getElementsByClassName("deslizador");
      function beforeAfter() {
      $(this).divisor.style.width = slider.value+"%";
      }
    


})