<?php
//debug($model);
\common\models\shop\ActivePages::setActiveUser();
?>
<!-- site__body -->
<div class="site__body">
    <div class="block about-us">
        <div class="about-us__image"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-xl-10">
                    <div class="about-us__body" style="padding: 14px 92px;">
                        <h1 class="about-us__title" style=" margin-bottom: 30px;"><?=$model->name?></h1>
                        <div class="delivery-us__text_no_center typography">
                            <?= $model->description ?>
                        </div>
                        <div class="about-us__team">
                            <!--                            <h2 class="about-us__team-title">Meat Our Team</h2>-->
                            <!--                            <div class="about-us__team-subtitle text-muted">Want to work in our friendly team?<br><a href="contact-us.html">Contact us</a> and we will consider your candidacy.</div>-->
                            <div class="about-us__teammates teammates">
                                <div class="owl-carousel">
                                    <div class="teammates__item teammate">
                                        <div class="teammate__avatar">
                                            <img src="/images/delivery_1.jpg" alt="Доставка">
                                        </div>
                                        <!--                                        <div class="teammate__name">Michael Russo</div>-->
                                        <!--                                        <div class="teammate__position text-muted">Chief Executive Officer</div>-->
                                    </div>
                                    <div class="teammates__item teammate">
                                        <div class="teammate__avatar">
                                            <img src="/images/delivery_2.jpg" alt="Доставка">
                                        </div>
                                        <!--                                        <div class="teammate__name">Katherine Miller</div>-->
                                        <!--                                        <div class="teammate__position text-muted">Marketing Officer</div>-->
                                    </div>
                                    <div class="teammates__item teammate">
                                        <div class="teammate__avatar">
                                            <img src="/images/delivery_3.jpg" alt="Доставка">
                                        </div>
                                        <!--                                        <div class="teammate__name">Anthony Harris</div>-->
                                        <!--                                        <div class="teammate__position text-muted">Finance Director</div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- site__body / end -->
