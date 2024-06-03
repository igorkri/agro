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
  // block posts carousel
  */
$(function () {
    $('.block-posts').each(function () {
        const layout = $(this).data('layout');
        const options = {
            margin: 30,
            nav: false,
            dots: false,
            loop: true,
            rtl: isRTL()
        };
        const layoutOptions = {
            'grid-3': {
                responsive: {
                    992: {items: 3},
                    768: {items: 2}
                }
            },
            'grid-4': {
                responsive: {
                    1200: {items: 4, margin: 20},
                    992: {items: 3, margin: 24},
                    768: {items: 2, margin: 20},
                    460: {items: 2, margin: 20}
                }
            },
            'list': {
                responsive: {
                    992: {items: 2},
                    0: {items: 1}
                }
            }
        };
        const owl = $('.block-posts__slider .owl-carousel');
        const owlOptions = $.extend({}, options, layoutOptions[layout]);

        if (/^grid-/.test(layout)) {
            let mobileResponsiveOptions = {};

            if (parseFloat($(this).data('mobile-columns')) === 2) {
                mobileResponsiveOptions = {
                    460: {items: 2, margin: 20},
                    400: {items: 2, margin: 16},
                    320: {items: 2, margin: 12}
                };
            } else {
                mobileResponsiveOptions = {
                    0: {items: 1}
                };
            }

            owlOptions.responsive = $.extend(
                {},
                owlOptions.responsive,
                mobileResponsiveOptions
            );

        }

        owl.owlCarousel(owlOptions);

        $(this).find('.block-header__arrow--left').on('click', function () {
            owl.trigger('prev.owl.carousel', [500]);
        });
        $(this).find('.block-header__arrow--right')
            .on('click', function () {
                owl.trigger('next.owl.carousel', [500]);
            });
    });
});
})(jQuery);