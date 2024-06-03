(function ($) {

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