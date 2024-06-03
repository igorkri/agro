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
                passiveSupported ? { passive: true } : false
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
})(jQuery);