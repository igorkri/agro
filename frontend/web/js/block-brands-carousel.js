(function ($) {

    let DIRECTION = null;

    function direction() {
        if (DIRECTION === null) {
            DIRECTION = getComputedStyle(document.body).direction;
        }

        return DIRECTION;
    }

    function isRTL() {
        return direction() === 'rtl';
    }

/*
  // block brands carousel
  */
$(function () {
    $('.block-brands__slider .owl-carousel').owlCarousel({
        nav: false,
        dots: false,
        loop: true,
        rtl: isRTL(),
        autoplay: true,
        autoplayTimeout: 2000,
        autoplayHoverPause: true,
        responsive: {
            1200: {items: 6},
            992: {items: 5},
            768: {items: 4},
            576: {items: 3},
            0: {items: 2}
        }
    });
});
})(jQuery);