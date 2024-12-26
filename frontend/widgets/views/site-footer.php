<?php

use yii\helpers\Url;

/** @var \common\models\Contact $contacts */

?>
<footer>
    <div class="site-footer">
        <?php if (Yii::$app->devicedetect->isMobile()): ?>
        <div class="container">
            <div class="site-footer__widgets">
                <?php else: ?>
                <br>
                <div class="container">
                    <div class="site-footer__widgets bk-1" style="margin: 0 0">
                        <?php endif; ?>
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="site-footer__widget footer-contacts">
                                    <h4 class="footer-contacts__title"><?= Yii::t('app', 'Наші контакти') ?></h4>
                                    <ul class="footer-contacts__contacts">
                                        <li>
                                            <i class="footer-contacts__icon fas fa-globe-americas"></i> <?= $contacts->address ?>
                                        </li>
                                        <li>
                                            <i class="footer-contacts__icon far fa-envelope"></i> <?= $contacts->email ?>
                                        </li>
                                        <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> <a
                                                    href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_primary) ?>"><?= $contacts->tel_primary ?></a>
                                        </li>
                                        <li><i class="footer-contacts__icon fas fa-mobile-alt"></i> <a
                                                    href="tel:<?= str_replace([' ', '(', ')', '-'], '', $contacts->tel_second) ?>"><?= $contacts->tel_second ?></a>
                                        </li>
                                        <li>
                                            <i class="footer-contacts__icon far fa-clock"></i> <?= $contacts->work_time_short ?>
                                        </li>
                                    </ul>
                                    <div class="footer-contacts__text  footer-color"><?= $contacts->comment_two ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="site-footer__widget footer-links">
                                    <h4 class="footer-links__title"><?= Yii::t('app', 'Інформація') ?></h4>
                                    <ul class="footer-links__list">
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['about/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Про нас') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['delivery/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Про доставку') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['contact/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Контакти') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['order/conditions']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Повернення') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['brands/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Бренди') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-6 col-md-3 col-lg-2">
                                <div class="site-footer__widget footer-links">
                                    <h4 class="footer-links__title"><?= Yii::t('app', 'Товари') ?></h4>
                                    <ul class="footer-links__list">
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['category/list']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Каталог') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['special/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Спеціальні пропозиції') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['blogs/view']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Статті') ?></a>
                                        </li>
                                        <li class="footer-links__item footer-color"><a
                                                    href="<?= Url::to(['tag/index']) ?>"
                                                    class="footer-links__link"><?= Yii::t('app', 'Теги') ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4">
                                <div class="site-footer__widget footer-newsletter">
                                    <h5 class="footer-newsletter__title"><?= Yii::t('app', 'Новини') ?></h5>
                                    <div class="footer-newsletter__text  footer-color">
                                        <?= Yii::t('app', 'Підпишіться на нашу розсилку новин.') ?>
                                    </div>
                                    <div class="alert alert-success" style="display: none;"
                                         id="success-message-footer" role="alert">
                                        <?= Yii::t('app', 'Вітаемо Ваше повідомлення -- надіслане !!!') ?>
                                    </div>
                                    <form id="form-mailing"
                                          data-url-mailing="<?php echo Yii::$app->urlManager->createUrl(['site/mailing-list']) ?>"
                                          class="footer-newsletter__form">
                                        <label class="sr-only"
                                               for="footer-newsletter-address"><?= Yii::t('app', 'Електронна адреса...') ?></label>
                                        <input type="email"
                                               class="footer-newsletter__form-input form-control"
                                               id="footer-newsletter-address"
                                               placeholder="<?= Yii::t('app', 'Електронна адреса...') ?>"
                                               required>
                                        <button class="footer-newsletter__form-button btn btn-primary"><?= Yii::t('app', 'Підписатись') ?></button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="site-footer__bottom">
                        <div class="site-footer__copyright">
                            © Copyright <?= date("Y") ?> <a href="/" target="_blank">agropro.org.ua</a>
                        </div>
                        <div class="site-footer__payments">
                            <img src="/images/payments.png" width="246" height="24" alt="AgroPro">
                        </div>
                    </div>
                </div>
                <div class="totop">
                    <div class="totop__body">
                        <div class="totop__start"></div>
                        <div class="totop__container container"></div>
                        <div class="totop__end">
                            <button type="button" class="totop__button">
                                <svg width="13px" height="8px">
                                    <use xlink:href="/images/sprite.svg#arrow-rounded-up-13x8"></use>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
</footer>
<style>
    #success-message-footer {
        position: absolute;
        top: -13%;
        left: 0;
        width: 100%;
    }

    .footer-color {
        background-color: rgba(251, 251, 250, 0.55);
        border-radius: 5px;
    }
</style>
<?php
$js = <<<JS

$(document).ready(function() {
    $('#form-mailing').on('submit', function(event) {
        event.preventDefault();

        var email = $('#footer-newsletter-address').val(); 
        var url = $(this).data('url-mailing');
        $.ajax({
            type: 'POST',
            url: url,
            data: { email: email },
            success: function(response) {
                if (response.success) {
                    $('#form-mailing')[0].reset();
                    $('#success-message-footer').fadeIn();
                    setTimeout(function() {
                        $('#success-message-footer').fadeOut();
                    }, 2500);
                } else {
                    console.log("Ошибка: " + response.message);
                }
            },
            error: function(data) {
                console.log("Ошибка", data);
            }
        });
    });
});

JS;
$this->registerJs($js);
?>
