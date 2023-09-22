<?php

\common\models\shop\ActivePages::setActiveUser();

?>
<div class="site__body">
    <div class="block">
        <div class="container">
            <div class="not-found">
                <div class="not-found__404">
                    Oops! Error 404
                </div>
                <div class="not-found__content">
                    <h1 class="not-found__title">Сторінку Не Знайдено</h1>
                    <p class="not-found__text">
                        Здається, ми не можемо знайти сторінку, яку ви шукаєте.<br>
                        Спробуйте скористатися пошуком.
                    </p>
                    <img src="/images/404.jpg" alt="Сторінку Не Знайдено">
                    <p class="not-found__text">
                        Або перейдіть на головну сторінку, щоб почати все спочатку.
                    </p>
                    <a class="btn btn-secondary btn-sm" href="/">На Головну Сторінку</a>
                </div>
            </div>
        </div>
    </div>
</div>