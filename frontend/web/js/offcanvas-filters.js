(function ($) {

/*
// offcanvas filters
*/
$(function () {
    const body = $('body');
    const blockSidebar = $('.block-sidebar');
    const mobileMedia = matchMedia('(max-width: 991px)');

    if (blockSidebar.length) {
        const open = function () {
            if (blockSidebar.is('' +
                '.block-sidebar--offcanvas--mobile')
                && !mobileMedia.matches) {
                return;
            }

            const bodyWidth = body.width();
            body.css('overflow', 'hidden');
            body.css('paddingRight', (body.width() - bodyWidth) + 'px');

            blockSidebar.addClass('block-sidebar--open');
        };
        const close = function () {
            body.css('overflow', '');
            body.css('paddingRight', '');

            blockSidebar.removeClass('block-sidebar--open');
        };
        const onChangeMedia = function () {
            if (blockSidebar.is('' +
                '.block-sidebar--open.block-sidebar--offcanvas--mobile')
                && !mobileMedia.matches) {
                close();
            }
        };

        $('.filters-button').on('click', function () {
            open();
        });
        $('.block-sidebar__backdrop, .block-sidebar__close')
            .on('click', function () {
                close();
            });

        if (mobileMedia.addEventListener) {
            mobileMedia.addEventListener('change', onChangeMedia);
        } else {
            mobileMedia.addListener(onChangeMedia);
        }
    }
});
})(jQuery);