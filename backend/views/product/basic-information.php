<?php

use vova07\imperavi\Widget;

?>
<div class="card">
    <div class="card-body p-5">
        <div class="mb-5">
                                    <span class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-cart"><h2
                                            class="mb-0 fs-exact-18">Основна інформація</h2></span>
        </div>
        <div class="card">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link active"
                            id="uk-tab-2"
                            data-bs-toggle="tab"
                            data-bs-target="#uk-tab-content-2"
                            type="button"
                            role="tab"
                            aria-controls="uk-tab-content-2"
                            aria-selected="true"
                        >
                            UK<span class="nav-link-sa-indicator"></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="ru-tab-2"
                            data-bs-toggle="tab"
                            data-bs-target="#ru-tab-content-2"
                            type="button"
                            role="tab"
                            aria-controls="ru-tab-content-2"
                            aria-selected="true"
                        >
                            RU<span class="nav-link-sa-indicator"></span>
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button
                            class="nav-link"
                            id="en-tab-2"
                            data-bs-toggle="tab"
                            data-bs-target="#en-tab-content-2"
                            type="button"
                            role="tab"
                            aria-controls="en-tab-content-2"
                            aria-selected="true"
                        >
                            EN<span class="nav-link-sa-indicator"></span>
                        </button>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content">
                    <div
                        class="tab-pane fade show active"
                        id="uk-tab-content-2"
                        role="tabpanel"
                        aria-labelledby="uk-tab-2"
                    >
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'class' => 'form-control']) ?>
                            </div>
                            <div class="col-md-4 mb-4">
                                <?= $form->field($model, 'date_updated')->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'value' => Yii::$app->formatter->asDatetime($model->date_updated),
                                    'readonly' => true,
                                ]) ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'short_description')->widget(Widget::class, [
                                'options' => ['id' => 'uk-short_description'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'fullscreen',
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'description')->widget(Widget::class, [
                                'options' => ['id' => 'uk-description'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'clips',
                                        'fullscreen',
                                    ],
                                    'clips' => [
                                        ['All h3 Descr...', '
                                                        <h3>Переваги використання :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Механізм дії :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Спосіб застосування, інструкція для :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Норма витрат препарату :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Рекомендації по застосуванню :</h3>
                                                        <p>-------------------</p>
                                                        '
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($model, 'footer_description')->widget(Widget::class, [
                                'options' => ['id' => 'uk-footer_description'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'fullscreen',
                                        'table',
                                        'clips',
                                    ],
                                    'clips' => [
                                        ['Footer Descr...', '
                                                        <p>---------------------------
                                                        </p>
                                                        <p><strong>Увага!!!</strong>  
                                                        Для безпечного використання препарату (*name_product*) 
                                                        та досягнення максимальної ефективності його дії, 
                                                        слід строго дотримуватися інструкцій виробника та правил техніки 
                                                        безпеки при обробці хімічних речовин.
                                                        </p>
                                                        <p>Інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        пропонує одні з найвигідніших цін на (*name_product*). 
                                                        Ви можете купити необхідний препарат на нашому веб-сайті, 
                                                        і наші менеджери оперативно оброблять та доставлять ваше замовлення.
                                                        </p>
                                                        <p>Наші модератори дуже уважно перевіряють інформацію, 
                                                        перед тим як публікувати її на сайті. Однак, на жаль, 
                                                        дані про товар можуть змінюватися виробником без попередження, 
                                                        тому інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        не несе відповідальності за точність опису, 
                                                        і наявна помилка не може служити підставою для повернення товару.
                                                        </p>'
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="ru-tab-content-2"
                        role="tabpanel"
                        aria-labelledby="ru-tab-2"
                    >
                        <?php if (isset($translateRu)):?>
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <?= $form->field($translateRu, 'name')->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'translateRu-name',
                                    'name' => 'ProductsTranslate[ru][name]',
                                ]) ?>
                            </div>
                            <div class="col-md-4 mb-4">
                                <?= $form->field($translateRu, 'date_updated')->textInput([
                                    'id' => 'translateRu-name',
                                    'name' => 'ProductsTranslate[ru][date_updated]',
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'value' => Yii::$app->formatter->asDatetime($model->date_updated),
                                    'readonly' => true,
                                ]) ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateRu, 'short_description')->widget(Widget::class, [
                                'options' => ['id' => 'ru-short_description', 'name' => 'ProductsTranslate[ru][short_description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'fullscreen',
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateRu, 'description')->widget(Widget::class, [
                                'options' => ['id' => 'ru-description', 'name' => 'ProductsTranslate[ru][description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'clips',
                                        'fullscreen',
                                    ],
                                    'clips' => [
                                        ['All h3 Descr...', '
                                                        <h3>Переваги використання :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Механізм дії :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Спосіб застосування, інструкція для :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Норма витрат препарату :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Рекомендації по застосуванню :</h3>
                                                        <p>-------------------</p>
                                                        '
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateRu, 'footer_description')->widget(Widget::class, [
                                'options' => ['id' => 'ru-footer_description', 'name' => 'ProductsTranslate[ru][footer_description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'fullscreen',
                                        'table',
                                        'clips',
                                    ],
                                    'clips' => [
                                        ['Footer Descr...', '
                                                        <p>---------------------------
                                                        </p>
                                                        <p><strong>Увага!!!</strong>  
                                                        Для безпечного використання препарату (*name_product*) 
                                                        та досягнення максимальної ефективності його дії, 
                                                        слід строго дотримуватися інструкцій виробника та правил техніки 
                                                        безпеки при обробці хімічних речовин.
                                                        </p>
                                                        <p>Інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        пропонує одні з найвигідніших цін на (*name_product*). 
                                                        Ви можете купити необхідний препарат на нашому веб-сайті, 
                                                        і наші менеджери оперативно оброблять та доставлять ваше замовлення.
                                                        </p>
                                                        <p>Наші модератори дуже уважно перевіряють інформацію, 
                                                        перед тим як публікувати її на сайті. Однак, на жаль, 
                                                        дані про товар можуть змінюватися виробником без попередження, 
                                                        тому інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        не несе відповідальності за точність опису, 
                                                        і наявна помилка не може служити підставою для повернення товару.
                                                        </p>'
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="en-tab-content-2"
                        role="tabpanel"
                        aria-labelledby="en-tab-2"
                    >
                        <?php if (isset($translateEn)):?>
                        <div class="row">
                            <div class="col-md-8 mb-4">
                                <?= $form->field($translateEn, 'name')->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'id' => 'translateEn-name',
                                    'name' => 'ProductsTranslate[en][name]',
                                ]) ?>
                            </div>
                            <div class="col-md-4 mb-4">
                                <?= $form->field($translateEn, 'date_updated')->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control',
                                    'value' => Yii::$app->formatter->asDatetime($model->date_updated),
                                    'readonly' => true,
                                    'id' => 'translateEn-name',
                                    'name' => 'ProductsTranslate[en][date_updated]',
                                ]) ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateEn, 'short_description')->widget(Widget::class, [
                                'options' => ['id' => 'en-short_description', 'name' => 'ProductsTranslate[en][short_description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'fullscreen',
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateEn, 'description')->widget(Widget::class, [
                                'options' => ['id' => 'en-description', 'name' => 'ProductsTranslate[en][description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'table',
                                        'fontcolor',
                                        'clips',
                                        'fullscreen',
                                    ],
                                    'clips' => [
                                        ['All h3 Descr...', '
                                                        <h3>Переваги використання :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Механізм дії :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Спосіб застосування, інструкція для :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Норма витрат препарату :</h3>
                                                        <p>-------------------</p>
                                                        <h3>Рекомендації по застосуванню :</h3>
                                                        <p>-------------------</p>
                                                        '
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <div class="mb-4">
                            <?= $form->field($translateEn, 'footer_description')->widget(Widget::class, [
                                'options' => ['id' => 'en-footer_description', 'name' => 'ProductsTranslate[en][footer_description]'],
                                'defaultSettings' => [
                                    'style' => 'position: unset;'
                                ],
                                'settings' => [
                                    'lang' => 'uk',
                                    'minHeight' => 100,
                                    'plugins' => [
                                        'fullscreen',
                                        'table',
                                        'clips',
                                    ],
                                    'clips' => [
                                        ['Footer Descr...', '
                                                        <p>---------------------------
                                                        </p>
                                                        <p><strong>Увага!!!</strong>  
                                                        Для безпечного використання препарату (*name_product*) 
                                                        та досягнення максимальної ефективності його дії, 
                                                        слід строго дотримуватися інструкцій виробника та правил техніки 
                                                        безпеки при обробці хімічних речовин.
                                                        </p>
                                                        <p>Інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        пропонує одні з найвигідніших цін на (*name_product*). 
                                                        Ви можете купити необхідний препарат на нашому веб-сайті, 
                                                        і наші менеджери оперативно оброблять та доставлять ваше замовлення.
                                                        </p>
                                                        <p>Наші модератори дуже уважно перевіряють інформацію, 
                                                        перед тим як публікувати її на сайті. Однак, на жаль, 
                                                        дані про товар можуть змінюватися виробником без попередження, 
                                                        тому інтернет-магазин <a href="https://agropro.org.ua/">AgroPro</a> 
                                                        не несе відповідальності за точність опису, 
                                                        і наявна помилка не може служити підставою для повернення товару.
                                                        </p>'
                                        ],
                                    ],
                                ],
                            ]); ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
