(function ($) {

/*
   // collapse
   */
$(function () {
    $('[data-collapse]').each(function (i, element) {
        const collapse = element;

        $('[data-collapse-trigger]', collapse).on('click', function () {
            const openedClass = $(this)
                .closest('[data-collapse-opened-class]')
                .data('collapse-opened-class');
            const item = $(this).closest('[data-collapse-item]');
            const content = item.children('[data-collapse-content]');
            const itemParents = item.parents();

            itemParents.slice(0, itemParents
                .index(collapse) + 1)
                .filter('[data-collapse-item]')
                .css('height', '');

            if (item.is('.' + openedClass)) {
                const startHeight = content.height();

                content.css('height', startHeight + 'px');
                item.removeClass(openedClass);

                content.height(); // force reflow
                content.css('height', '');
            } else {
                const startHeight = content.height();

                item.addClass(openedClass);

                const endHeight = content.height();

                content.css('height', startHeight + 'px');
                content.height(); // force reflow
                content.css('height', endHeight + 'px');
            }
        });

        $('[data-collapse-content]', collapse)
            .on('transitionend', function (event) {
                if (event.originalEvent.propertyName === 'height') {
                    $(this).css('height', '');
                }
            });
    });
});
})(jQuery);