
var $Slider2 = $("#cardSlider");
$(window).resize(function () {
  ShowSlider2();
});
function ShowSlider2() {
  if ($Slider2.data("owlCarousel") !== "undefined") {
    if (window.matchMedia("(max-width: 991px)").matches) {
      $Slider2.addClass("owl-carousel").owlCarousel({
        items: 3,
        loop: false,
        autoplay: false,
        autoplayTimeout: 2000,
        nav: false,
        dots: false,
        responsiveClass: true,
        responsive: {
          0: {
            items: 1,
            stagePadding: 15,
          },
          568: {
            items: 1,
            stagePadding: 50,
          },
          768: {
            items: 2,
          },
          991: {
            items: 3,
          },
        },
      });
    } else {
      $Slider2.trigger("destroy.owl.carousel").removeClass("owl-carousel");
    }
  }
}
ShowSlider2();
