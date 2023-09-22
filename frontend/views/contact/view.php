<?php

\common\models\shop\ActivePages::setActiveUser();

?>
<div class="site__body">
    <div class="page-header">
        <div class="page-header__container container">
            <div class="page-header__breadcrumb">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/"> <i class="fas fa-home"></i> Головна</a>
                            <svg class="breadcrumb-arrow" width="6px" height="9px">
                                <use xlink:href="/images/sprite.svg#arrow-rounded-right-6x9"></use>
                            </svg>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Зв'язок з нами</li>
                    </ol>
                </nav>
            </div>
            <div class="page-header__title">
                <h1>Зв'язок з нами</h1>
            </div>
        </div>
    </div>
    <div class="block">
        <div class="container">
            <div class="card mb-0 contact-us">
                <div class="card-body">
                    <div class="contact-us__container">
                        <div class="row">
                            <div class="col-12 col-lg-6 pb-4 pb-lg-0">
                                <h4 class="contact-us__header card-title">Наша адреса</h4>
                                <div class="contact-us__address">
                                    <p>
                                        <?= $contacts->address ?><br>
                                        Email: <?= $contacts->email ?><br>
                                        Телефон: <?= $contacts->tel_primary ?><br>
                                    <p style="padding-left: 72px; margin-top: -15px;"> <?= $contacts->tel_second ?></p>
                                    </p>
                                    <p>
                                        <strong>Години роботи</strong><br>
                                        <?= $contacts->hours_work ?>
                                    </p>
                                    <p>
                                        <?= $contacts->coments ?>
                                    </p>
                                </div>
                            </div>
                            <?= $this->render('message') ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>