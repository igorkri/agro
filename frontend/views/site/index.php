<?php

/** @var yii\web\View $this */

use frontend\assets\HomePageAsset;
use frontend\widgets\BlockBrands;
use frontend\widgets\BlockPosts;
use frontend\widgets\ProductsCarouselGazon;
use frontend\widgets\ProductsCarousel;
use frontend\widgets\FeaturedProduct;
use frontend\widgets\BlockSlideshow;
use common\models\shop\ActivePages;
use frontend\widgets\BlockFeatures;
use frontend\widgets\BlockBanner;
use frontend\widgets\ViewProduct;

HomePageAsset::register($this);
ActivePages::setActiveUser();

?>
    <div class="site__body">
        <?php echo BlockSlideshow::widget() ?>
        <?php echo BlockFeatures::widget() ?>
        <?php echo ProductsCarouselGazon::widget() ?>
        <?php echo FeaturedProduct::widget() ?>
        <?php echo BlockBanner::widget() ?>
        <div id="url" data-url="<?= Yii::$app->urlManager->createUrl(['site/load-content']) ?>"></div>
        <div id="bestsellers-container" data-widget="bestsellers"></div>
        <div id="popular-categories-container" data-widget="popular-categories"></div>
        <div id="bestsellers-dacha-container" data-widget="bestsellers-dacha"></div>
        <?php echo ProductsCarousel::widget() ?>
        <?php echo BlockPosts::widget() ?>
        <?php echo BlockBrands::widget() ?>
        <div id="columns-container" data-widget="columns"></div>
        <?php if (Yii::$app->session->get('viewedProducts', [])) echo ViewProduct::widget() ?>
    </div>
    <div class="container" id="home-description">
        <hr>
        <h1 style="text-align: center;">Інтернет-магазин засобів захисту рослин AgroPro</h1>
        <p>Українські фермерські господарства, сільськогосподарські товариства та власники дачних і городніх ділянок
            активно займаються вирощуванням овочевих та сільськогосподарських культур.
            Магазин AgroPro пропонує широкий асортимент продукції, необхідної для успішного вирощування рослин. Тут
            можна знайти засоби захисту рослин, фуміганти, посівний матеріал для зернових культур, а також якісні
            добрива. Вся продукція магазину є сертифікованою і має підтверджену якість. Крім того, фахівці магазину
            завжди готові надати професійну консультацію та допомогти вибрати необхідний товар як для фермерів, так і
            для городників.
        </p>
        <div class="full-description" style="display: none;">
            <h2 style="text-align: center;">Продукція для саду та городу включає в себе засоби захисту рослин, добрива,
                а також інші необхідні товари.</h2>
            <p>Запрошую відвідати наш інтернет-магазин ЗЗР, добрив та насіння, де ви зможете знайти все необхідне без
                виходу
                з дому. У нашому зручному каталозі або скориставшись пошуком ви знайдете:
            </p>
            <ul>
                <li>Гербіциди, Інсектициди, Протруйники, Фунгіциди, Десиканти, Прилипачі, Біопрепарати</li>
                <li>Фуміганти, Родентициди, Пастки та принади для гризунів</li>
                <li>Мінеральні добрива, Органічні добрива, Мікродобрива</li>
                <li>Посівний матеріал соняшнику, кукурудзи та газонної трави</li>
                <li>Біодеструктори для компостування та вигрібних ям</li>
            </ul>
            <h3 style="text-align: center;">Співробітництво з агромагазином AgroPro має безліч переваг:</h3>
            <p>Ми маємо понад 10-річний досвід роботи на ринку. Наша команда постійно працює над вдосконаленням процесів
                обслуговування клієнтів. Також ми успішно співпрацюємо з фермерськими господарствами та власниками
                городніх ділянок.
            </p>
            <p>У нашому інтернет-магазині засобів захисту рослин ви знайдете все необхідне для саду та городу. Співпраця
                з AgroPro надає фермерам та городникам такі переваги:
            </p>
            <ul>
                <li>Широкий вибір: AgroPro пропонує різноманітні товари для сільського господарства, такі як засоби
                    захисту рослин, добрива, посівний матеріал та багато іншого.
                </li>
                <li>Висока якість: Всі товари в асортименті AgroPro проходять сертифікацію і відповідають вимогам якості
                    та безпеки.
                </li>
                <li>Професійні консультації: Фахівці AgroPro нададуть вам компетентну консультацію щодо вибору
                    оптимальних товарів для вашого господарства чи городу.
                </li>
                <li>Зручність покупок: Ви можете замовити необхідні товари в інтернет-магазині AgroPro, що зекономить
                    ваш час та зусилля.
                </li>
                <li>В розділі "Статті" ви знайдете відповіді на багато запитань та багато корисних порад з різноманітних
                    тем, пов'язаних з агропродукцією та сільським господарством.
                </li>
                <li>Надійність: AgroPro гарантує швидку доставку та надійне обслуговування, щоб зробити ваші покупки
                    максимально комфортними.
                </li>
            </ul>
            <p>Обирайте співробітництво з AgroPro і отримайте доступ до найкращих агропродуктів та послуг!
            </p>
        </div>
        <div style="display: flex; justify-content: center">
            <button class="btn btn-secondary" id="show-more-btn">Детальніше... >>></button>
            <button class="btn btn-secondary" id="hide-description-btn" style="display: none;">Приховати
                опис <<<
            </button>
        </div>
    </div>
<?php
$js = <<<JS
    
var containersInfo = [
    { selector: '#bestsellers-container', loaded: false },
    { selector: '#popular-categories-container', loaded: false },
    { selector: '#bestsellers-dacha-container', loaded: false },
    { selector: '#columns-container', loaded: false }
];

function loadContent(containerInfo, containerTop) {
    if ($(window).scrollTop() >= containerTop - $(window).height() && !containerInfo.loaded) {
        var widgetName = $(containerInfo.selector).data('widget');
        var url = $('#url').attr('data-url');
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            data: { widgetName: widgetName },
            success: function(response) {
                if (response.success && !containerInfo.loaded) {
                    $(containerInfo.selector).append(response.content);
                    containerInfo.loaded = true;
                }
            }
        });
    }
}

$(window).scroll(function() {
    containersInfo.forEach(function(containerInfo) {
        var containerTop = $(containerInfo.selector).offset().top;
        loadContent(containerInfo, containerTop);
    });
});

    
   $(document).ready(function () {
        var fullDescription = $('.full-description');
        var showMoreBtn = $('#show-more-btn');
        var hideDescriptionBtn = $('#hide-description-btn');
        fullDescription.hide();
        showMoreBtn.click(function () {
            fullDescription.fadeIn();
             hideDescriptionBtn.show();
            showMoreBtn.hide();
        });
        hideDescriptionBtn.click(function () {
            fullDescription.fadeOut();
            hideDescriptionBtn.hide();
            showMoreBtn.show();
        });
    });

JS;
$this->registerJs($js);
?>