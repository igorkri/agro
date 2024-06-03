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
 // price filter
 */

$(function () {
    $('.filter-price').each(function (i, element) {
        const min = $(element).data('min');
        const max = $(element).data('max');
        const from = $(element).data('from');
        const to = $(element).data('to');
        const slider = element.querySelector('.filter-price__slider');

        noUiSlider.create(slider, {
            start: [from, to],
            connect: true,
            direction: isRTL() ? 'rtl' : 'ltr',
            range: {
                'min': min,
                'max': max
            }
        });

        const titleValues = [
            $(element).find('.filter-price__min-value')[0],
            $(element).find('.filter-price__max-value')[0]
        ];

        slider.noUiSlider.on('update', function (values, handle) {
            titleValues[handle].innerHTML = values[handle];

            $('#minPrice').val(values[0]);
            $('#maxPrice').val(values[1]);

        });
    });
});
})(jQuery);