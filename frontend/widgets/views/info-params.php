<style>
    .tooltip {
        z-index:999;
        left:-9999px;
        top:-9999px;
        border:1px solid #d9dcd9;
        font-size:14px;
        color: #434141;
        padding:4px 8px;
        position:absolute;
    }
    .tooltip p {
        margin: 0px;
        padding: 0px;
        width: 220px;
    }

</style>

<?php

$js = <<<JS

 jQuery(document).ready(function ($) {
    function l_tooltip(target_items, name) {
        $('.product-card__quickview').each(function (i) {
            var button = $(this);
            var tooltipId = name + i;
            var tooltipExists = $("#" + tooltipId).length > 0;
            
            if (button.data("title") != "" && button.data("title") != "undefined") {
                button.mouseenter(function () {
                    if (isMobileDevice()) {
                        return; // Прекратить отображение подсказки на мобильных устройствах
                    }

                    // Скрываем все существующие подсказки
                    $(".tooltip").hide();
                    
                    // Создаем новую подсказку, если она еще не существует
                    if (!tooltipExists) {
                        $("body").append("<div class='" + name + "' id='" + tooltipId + "'></div>");
                        tooltipExists = true;
                    }
                    
                    var tooltip = $("#" + tooltipId);
                    tooltip.html("<p>" + button.data('title') + "</p>").css({
                        opacity: 0.9,
                        display: "block",
                        position: "absolute",
                        background: "#fcfafa",
                        color: "#434141",
                        padding: "10px",
                        borderRadius: "4px",
                        left: (button.offset().left - tooltip.outerWidth()) + "px",
                         top: button.offset().top + "px"
                    });
                }).mouseleave(function () {
                    // Скрываем подсказку только если она существует
                    if (tooltipExists) {
                        $("#" + tooltipId).fadeOut(30);
                    }
                });

                button.find("svg").mouseout(function (event) {
                    event.stopPropagation();
                });
            }
        });
    }

    // Проверка, является ли устройство мобильным
    function isMobileDevice() {
        return (typeof window.orientation !== "undefined") || (navigator.userAgent.indexOf('IEMobile') !== -1);
    }

    l_tooltip(".ttp_inf button", "tooltip");
});

JS;
$this->registerJs($js);

?>
