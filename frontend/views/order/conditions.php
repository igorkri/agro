<?php

use frontend\assets\ConditionsPageAsset;
use yii\helpers\Url;

ConditionsPageAsset::register($this);

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"><?=Yii::t('app','Головна')?></a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page"> <?=Yii::t('app','Умови повернення та обміну')?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="document">
                <div class="document__header">
                    <h1 class="document__title">Умови повернення та обміну</h1>
                    <div class="document__subtitle">Ця Угода була востаннє змінена 27 жовтня 2023 року.</div>
                </div>
                <div class="document__content typography">
                    <p>
                        Компанія здійснює повернення та обмін цього товару відповідно до вимог законодавства.
                    </p>
                    <h2>Терміни повернення</h2>
                    <ol>
                        <li>
                            Повернення можливе протягом 14 днів після отримання (для товарів належної якості).
                        </li>
                        <li>
                            Зворотня доставка товарів здійснюється за домовленістю.
                        </li>
                        <li>
                            Згідно з чинним законодавством ви можете повернути товар належної якості або обміняти його,
                            у разі:
                            <ul>
                                <li>товар не був у вживанні і не має слідів використання споживачем: подряпин, сколів,
                                    потертостей, плям і т.п.;
                                </li>
                                <li>товар повністю укомплектований і збережена фабрична упаковка;</li>
                                <li>збережені всі ярлики і заводське маркування;</li>
                                <li>товар зберігає товарний вигляд і свої споживчі властивості.</li>
                            </ul>
                        </li>
                    </ol>
                    <p>Згідно із Законом «Про захист прав споживачів», компанія може відмовити споживачеві в обміні та поверненні товарів належної якості, якщо вони відносяться до категорій, що зазначені у чинному Переліку непродовольчих товарів належної якості, не підлягають поверненню та обміну.</p>

                    <p>Щоб дізнатися, як з нами зв’язатися, відвідайте нашу <a href="<?= Url::to(['/contact/view']) ?>">сторінку
                            контакти</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>