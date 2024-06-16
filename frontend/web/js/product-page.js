(function ($) {

    let passiveSupported = false;

    try {
        const options = Object.defineProperty({}, 'passive', {
            get: function () {
                passiveSupported = true;
            }
        });

        window.addEventListener('test', null, options);
    } catch (err) {
    }

    /*
      // product tabs
      */
    $(function () {
        $('.product-tabs').each(function (i, element) {
            const list = $('.product-tabs__list', element);

            list.on('click', '.product-tabs__item', function (event) {
                event.preventDefault();

                const tab = $(this);
                const pane = $('.product-tabs__pane' +
                    $(this).attr('href'), element);


                if ($(element).is('.product-tabs--stuck')) {
                    window.scrollTo(0, $(element)
                        .find('.product-tabs__content')
                        .offset().top - $(element)
                        .find('.product-tabs__list-body')
                        .outerHeight() + 2);
                }

                if (pane.length) {
                    $('.product-tabs__item')
                        .removeClass('product-tabs__item--active');
                    tab.addClass('product-tabs__item--active');

                    $('.product-tabs__pane')
                        .removeClass('product-tabs__pane--active');

                    pane.addClass('product-tabs__pane--active');
                }
            });

            const currentTab = $('.product-tabs__item--active', element);
            const firstTab = $('.product-tabs__item:first', element);

            if (currentTab.length) {
                currentTab.trigger('click');
            } else {
                firstTab.trigger('click');
            }

            if ($(element).is('.product-tabs--sticky')) {
                let stuckWhen = null;
                let fixedWhen = null;

                function calc() {
                    stuckWhen = list.offset().top + list.outerHeight();
                    fixedWhen = $(element)
                        .find('.product-tabs__content')
                        .offset()
                        .top - $(element)
                        .find('.product-tabs__list-body')
                        .outerHeight() + 2;

                }

                function onScroll() {
                    if (stuckWhen === null || fixedWhen === null) {
                        calc();
                    }

                    if (window.pageYOffset >= stuckWhen) {
                        $(element).addClass('product-tabs--stuck');
                    } else if (window.pageYOffset < fixedWhen) {
                        $(element).removeClass('product-tabs--stuck');
                        $(element)
                            .removeClass('product-tabs--header-stuck-hidden');

                    }
                }

                window.addEventListener(
                    'scroll',
                    onScroll,
                    passiveSupported ? {passive: true} : false
                );


                $(document).on('stroyka.header.sticky.show', function () {
                    $(element).addClass('product-tabs--header-stuck');
                    $(element).removeClass('product-tabs--header-stuck-hidden');
                });
                $(document).on('stroyka.header.sticky.hide', function () {
                    $(element).removeClass('product-tabs--header-stuck');

                    if ($(element).is('.product-tabs--stuck')) {
                        $(element)
                            .addClass('product-tabs--header-stuck-hidden');

                    }
                });
                $(window).on('resize', function () {
                    stuckWhen = null;
                    fixedWhen = null;
                });

                onScroll();
            }
        });
    });

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
      // product gallery
      */
    const initProductGallery = function (element, layout) {
        layout = layout !== undefined ? layout : 'standard';

        const options = {
            dots: true,
            margin: 10,
            rtl: isRTL()
        };
        const layoutOptions = {
            standard: {
                responsive: {
                    1200: {items: 5},
                    992: {items: 4},
                    768: {items: 3},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            sidebar: {
                responsive: {
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            columnar: {
                responsive: {
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            },
            quickview: {
                responsive: {
                    1200: {items: 5},
                    768: {items: 4},
                    480: {items: 5},
                    380: {items: 4},
                    0: {items: 3}
                }
            }
        };

        const gallery = $(element);

        const image = gallery.find('.product-gallery__featured .owl-carousel');
        const carousel = gallery
            .find('.product-gallery__carousel ' +
                '.owl-carousel');
        carousel.css('display', 'none');
        image
            .owlCarousel({items: 1, dots: false, rtl: isRTL()})
            .on('changed.owl.carousel', syncPosition);

        carousel
            .on('initialized.owl.carousel', function () {
                carousel.find('.product-gallery__carousel-item')
                    .eq(0).addClass('product-gallery__carousel-item--active');
            })
            .owlCarousel($.extend({}, options, layoutOptions[layout]));

        carousel.on('click', '.owl-item', function (e) {
            e.preventDefault();

            image.data('owl.carousel').to($(this).index(), 300, true);
        });

        gallery.find('.product-gallery__zoom').on('click', function () {
            openPhotoSwipe(image.find('.owl-item.active').index());
        });

        image.on('click', '.owl-item a', function (event) {
            event.preventDefault();

            openPhotoSwipe($(this).closest('.owl-item').index());
        });

        function getIndexDependOnDir(index) {
            // We need to invert index id direction === 'rtl'
// because photoswipe do not support rtl

            if (isRTL()) {
                return image.find('.owl-item img').length - 1 - index;
            }

            return index;
        }

        function openPhotoSwipe(index) {
            const photoSwipeImages = image
                .find('.owl-item a')
                .toArray()
                .map(function (element) {
                    const img = $(element).find('img')[0];
                    const width = $(element).data('width') || img.naturalWidth;
                    const height = $(element).data('height') || img.naturalHeight;

                    return {
                        src: element.href,
                        msrc: element.href,
                        w: width,
                        h: height,
                    };
                });

            if (isRTL()) {
                photoSwipeImages.reverse();
            }

            const photoSwipeOptions = {
                getThumbBoundsFn: function (index) {
                    const imageElements = image.find('.owl-item img').toArray();
                    const dirDependentIndex = getIndexDependOnDir(index);

                    if (!imageElements[dirDependentIndex]) {
                        return null;
                    }

                    const imageElement = imageElements[dirDependentIndex];
                    const pageYScroll = window.pageYOffset || document
                        .documentElement.scrollTop;
                    const rect = imageElement.getBoundingClientRect();

                    return {
                        x: rect.left, y: rect.top
                            + pageYScroll, w: rect.width
                    };
                },
                index: getIndexDependOnDir(index),
                bgOpacity: 0.9,
                history: false
            };

            const photoSwipeGallery = new PhotoSwipe($('' +
                '.pswp')[0], PhotoSwipeUI_Default,
                photoSwipeImages, photoSwipeOptions);

            photoSwipeGallery.listen('beforeChange', function () {
                image.data('owl.carousel')
                    .to(getIndexDependOnDir(photoSwipeGallery
                        .getCurrentIndex()), 0, true);
            });

            photoSwipeGallery.init();
        }

        function syncPosition(el) {
            let current = el.item.index;

            carousel
                .find('.product-gallery__carousel-item')
                .removeClass('product-gallery__carousel-item--active')
                .eq(current)
                .addClass('product-gallery__carousel-item--active');
            const onscreen = carousel.find('.owl-item.active').length - 1;
            const start = carousel.find('.owl-item.active').first().index();
            const end = carousel.find('.owl-item.active').last().index();

            if (current > end) {

                var owlData = carousel.data('owl.carousel');

                if (owlData && owlData.to) {
                    owlData.to(current, 100, true);
                }

            }
            if (current < start) {
                carousel.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }
    };

    $(function () {
        $('.product').each(function () {
            const gallery = $(this).find('.product-gallery');

            if (gallery.length > 0) {
                initProductGallery(gallery[0], $(this).data('layout'));
            }
        });
    });

    /*
 // Checkout payment methods
 */
    $(function () {
        $('[name="checkout_payment_method"]')
            .on('change', function () {
                const currentItem = $(this).closest('.payment-methods__item');

                $(this).closest('.payment-methods__list')
                    .find('.payment-methods__item')
                    .each(function (i, element) {
                        const links = $(element);
                        const linksContent = links
                            .find('.payment-methods__item-container');

                        if (element !== currentItem[0]) {
                            const startHeight = linksContent.height();

                            linksContent.css('height', startHeight + 'px');
                            links.removeClass('payment-methods__item--active');
                            linksContent.height(); // force reflow

                            linksContent.css('height', '');
                        } else {
                            const startHeight = linksContent.height();

                            links.addClass('payment-methods__item--active');

                            const endHeight = linksContent.height();

                            linksContent.css('height', startHeight + 'px');
                            linksContent.height(); // force reflow
                            linksContent.css('height', endHeight + 'px');
                        }
                    });
            });

        $('.payment-methods__item-container')
            .on('transitionend', function (event) {
                if (event.originalEvent.propertyName === 'height') {
                    $(this).css('height', '');
                }
            });
    });
})(jQuery);