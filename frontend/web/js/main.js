/* global setTimeout */
(function ($) {
    'use strict';

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
    // block slideshow
    */
    $(function () {
        $('.block-slideshow .owl-carousel').owlCarousel({
            items: 1,
            nav: false,
            dots: true,
            loop: true,
            rtl: isRTL(),
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true
        });
    });

    /*
    // teammates
    */
    $(function () {
        $('.teammates .owl-carousel').owlCarousel({
            nav: false,
            dots: true,
            rtl: isRTL(),
            responsive: {
                768: {items: 3, margin: 32},
                380: {items: 2, margin: 24},
                0: {items: 1}
            }
        });
    });

    /*
    // add cart
    */
    const quickview = {
        cancelPreviousModal: function () {
        },
        clickHandler: function () {
            const modal = $('#quickview-modal');
            const button = $(this);
            quickview.cancelPreviousModal();

            button.addClass('product-card__addtocart--preload');
            button.addClass('btn-loading');
            button.html(
                '<svg width="20px" height="20px" style="display: unset;">\n' +
                '    <use xlink:href="/images/sprite.svg#cart-20"></use>\n' +
                '</svg> В кошику'
            );

            let prodId = $(this).data('productId');
            let urlQuickview = $(this).data('urlQuickview');
            let urlQtyCart = $(this).data('urlQtyCart');

            let xhr = $.ajax({
                url: urlQuickview,
                data: {
                    id: prodId,
                    qty: 1
                },
                success: function (data) {
                    $.ajax({
                        url: urlQtyCart,
                        success: function (qty) {
                            $('#desc-qty-cart').html(qty.qty_cart);
                        }
                    });

                    button.removeClass('product-card__addtocart--preload');
                    button.removeClass('btn-loading');
                    modal.find('.modal-content').html(data);
                    modal.find('.quickview__close').on('click', function () {
                        modal.modal('hide');
                    });

                    modal.modal('show');
                }
            });

            quickview.cancelPreviousModal = function () {
                button.removeClass('product-card__addtocart--preload');

                if (xhr) {
                    xhr.abort();
                }
            };
        }
    };

    $(function () {
        const modal = $('#quickview-modal');

        modal.on('shown.bs.modal', function () {
            // modal.find('.product').each(function () {
            //     const gallery = $(this).find('.product-gallery');
            //
            //     if (gallery.length > 0) {
            //         initProductGallery(gallery[0], $(this).data('layout'));
            //     }
            // });

            $('.input-number', modal).customNumber();
        });

        $(document).on('click', '.product-card__addtocart', function (event) {
            quickview.clickHandler.apply(this, arguments);
        });
    });


    /*
    // products carousel
    */
    $(function () {
        $('.block-products-carousel').each(function () {
            const layout = $(this).data('layout');
            const options = {
                items: 4,
                margin: 14,
                nav: false,
                dots: false,
                loop: false,
                stagePadding: 1,
                rtl: isRTL()
            };
            const layoutOptions = {
                'grid-4': {
                    responsive: {
                        1200: {items: 4, margin: 14},
                        992: {items: 4, margin: 10},
                        768: {items: 3, margin: 10}
                    }
                },
                'grid-4-sm': {
                    responsive: {
                        1200: {items: 4, margin: 14},
                        992: {items: 3, margin: 10},
                        768: {items: 3, margin: 10}
                    }
                },
                'grid-5': {
                    responsive: {
                        1200: {items: 5, margin: 12},
                        992: {items: 4, margin: 10},
                        768: {items: 3, margin: 10}
                    }
                },
                'horizontal': {
                    items: 3,
                    responsive: {
                        1200: {items: 3, margin: 14},
                        992: {items: 3, margin: 10},
                        768: {items: 2, margin: 10},
                        576: {items: 1},
                        475: {items: 1},
                        0: {items: 1}
                    }
                }
            };
            const owl = $('.owl-carousel', this);
            let cancelPreviousTabChange = function () {
            };

            const owlOptions = $.extend({}, options, layoutOptions[layout]);

            if (/^grid-/.test(layout)) {
                let mobileResponsiveOptions;

                if (parseFloat($(this).data('mobile-grid-columns')) === 2) {
                    mobileResponsiveOptions = {
                        420: {items: 2, margin: 10},
                        320: {items: 2, margin: 0},
                        0: {items: 1}
                    };
                } else {
                    mobileResponsiveOptions = {
                        475: {items: 2, margin: 10},
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

            $(this).find('.block-header__group').on('click', function (event) {
                const block = $(this).closest('.block-products-carousel');

                event.preventDefault();

                if ($(this).is('.block-header__group--active')) {
                    return;
                }

                cancelPreviousTabChange();

                block.addClass('block-products-carousel--loading');
                $(this)
                    .closest('.block-header__groups-list')
                    .find('.block-header__group--active')
                    .removeClass('block-header__group--active');

                $(this).addClass('block-header__group--active');

                let items = block
                    .find('.owl-carousel .owl-item:not(".cloned") ' +
                        '.block-products-carousel__column');


                block.find('.owl-carousel')
                    .trigger('replace.owl.carousel', [items])
                    .trigger('refresh.owl.carousel')
                    .trigger('to.owl.carousel', [0, 0]);

                $('.product-card__addtocart', block)
                    .on('click', function () {
                        quickview.clickHandler.apply(this, arguments);
                    });

                block.removeClass('block-products-carousel--loading');

                cancelPreviousTabChange = function () {
                    cancelPreviousTabChange = function () {
                    };
                };
            });

            $(this).find('.block-header__arrow--left')
                .on('click', function () {
                    owl.trigger('prev.owl.carousel', [500]);
                });
            $(this).find('.block-header__arrow--right')
                .on('click', function () {
                    owl.trigger('next.owl.carousel', [500]);
                });
        });
    });

    /*
    // mobilemenu
    */
    $(function () {
        const body = $('body');
        const mobilemenu = $('.mobilemenu');

        if (mobilemenu.length) {
            const open = function () {
                const bodyWidth = body.width();
                body.css('overflow', 'hidden');
                body.css('paddingRight', (body.width() - bodyWidth) + 'px');

                mobilemenu.addClass('mobilemenu--open');
            };
            const close = function () {
                body.css('overflow', '');
                body.css('paddingRight', '');

                mobilemenu.removeClass('mobilemenu--open');
            };


            $('.mobile-header__menu-button').on('click', function () {
                open();
            });
            $('.mobilemenu__backdrop, ' +
                '.mobilemenu__close')
                .on('click', function () {
                    close();
                });
        }
    });

    /*
    // tooltips
    */
    $(function () {
        $('[data-toggle="tooltip"]').tooltip({
            animation: true,
            // container: 'body',
            container: 'window',
            // delay: { show: 100, hide: 500 },
            html: false,
            placement: 'auto',
            title: '',
            trigger: 'hover'
        });
    });

    /*
    // totop
    */
    $(function () {
        let show = false;

        $('.totop__button').on('click', function () {
            $('html, body').animate({scrollTop: 0}, '300');
        });

        let fixedPositionStart = 300;

        window.addEventListener('scroll', function () {
            if (window.pageYOffset >= fixedPositionStart) {
                if (!show) {
                    show = true;
                    $('.totop').addClass('totop--show');
                }
            } else {
                if (show) {
                    show = false;
                    $('.totop').removeClass('totop--show');
                }
            }
        }, passiveSupported ? {passive: true} : false);
    });

    /*
   // Heder cart button
   */
    $('.cart-header').click(function () {
        const modal = $('#quickview-modal');
        const button = $(this);
        const doubleClick = button.is('.product-card__addtocart--preload');

        let url = button.find('.indicator__button').data('urlQuickViewAll');

        quickview.cancelPreviousModal();

        if (doubleClick) {
            return;
        }

        button.addClass('product-card__addtocart--preload');
        button.addClass('btn-loading');

        let xhr = null;
        xhr = $.ajax({
            url: url,
            success: function (data) {
                quickview.cancelPreviousModal = function () {
                };
                button.removeClass('product-card__addtocart--preload');
                button.removeClass('btn-loading');

                modal.find('.modal-content').html(data);
                modal.find('.quickview__close').on('click', function () {
                    modal.modal('hide');
                });
                modal.modal('show');
            }
        });

        quickview.cancelPreviousModal = function () {
            button.removeClass('product-card__addtocart--preload');

            if (xhr) {
                xhr.abort();
            }
        };
    });

    /*
    // Add wish list
     */
    $(document).ready(function () {
        $(document).on('click', '.product-card__wish', function (e) {
            e.preventDefault();
            var wishIndicator = $('#wish-indicator');
            var productId = $(this).data('wish-product-id');
            var url = $(this).data('url-wish');
            $.ajax({
                url: url,
                type: 'POST',
                data: {id: productId},
                success: function (response) {
                    if (response.success) {
                        wishIndicator.text(response.wishCount);
                        $('#success-wish').fadeIn(); // Показать сообщение

                        setTimeout(function () {
                            $('#success-wish').fadeOut();
                        }, 2500);

                    } else {
                        console.log('ошибка при добавлении в список сравнения');
                    }
                },
                error: function () {
                    console.log('ошибка при выполнении AJAX-запроса');
                }
            });
        });
    });

    /*
   // Add compare list
   */
    $(document).ready(function () {
        $(document).on('click', '.product-card__compare', function (e) {
            e.preventDefault();
            var compareIndicator = $('#compare-indicator');
            var productId = $(this).data('compare-product-id');
            var url = $(this).data('url-compare');
            $.ajax({
                url: url,
                type: 'POST',
                data: {id: productId},
                success: function (response) {
                    if (response.success) {
                        compareIndicator.text(response.compareCount);
                        $('#success-compare').fadeIn();

                        setTimeout(function () {
                            $('#success-compare').fadeOut();
                        }, 2500);

                    } else {
                        console.log('ошибка при добавлении в список сравнения');
                    }
                },
                error: function () {
                    console.log('ошибка при выполнении AJAX-запроса');
                }
            });
        });
    });

})(jQuery);