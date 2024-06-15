<?php

/** @var common\models\Report $model */
/** @var common\models\Report $budget */
/** @var common\models\Report $bigSum */
/** @var common\models\Report $bigIncomingPriceSum */
/** @var common\models\Report $bigDiscount */
/** @var common\models\Report $bigDelivery */
/** @var common\models\Report $bigPlatform */
/** @var common\models\Report $smallSum */
/** @var common\models\Report $smallIncomingPriceSum */
/** @var common\models\Report $smallDiscount */
/** @var common\models\Report $smallDelivery */
/** @var common\models\Report $smallPlatform */
/** @var common\models\Report $periodStart */
/** @var common\models\Report $periodEnd */
/** @var common\models\Report $bigQty */
/** @var common\models\Report $smallQty */

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = Yii::t('app', 'Reports Advertising');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reports'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$bigProfit = $bigSum
    - $bigIncomingPriceSum
    - $bigDiscount
    - $bigDelivery
    - $bigPlatform;

$smallProfit = $smallSum
    - $smallIncomingPriceSum
    - $smallDiscount
    - $smallDelivery
    - $smallPlatform;

if ($bigQty + $smallQty == 0) {
    $clientPrice = $budget;
} else {
    $clientPrice = $budget / ($bigQty + $smallQty);
}

?>

<div id="top" class="sa-app__body">
    <div class="sa-invoice">
        <div class="py-5">
            <div class="row g-4 align-items-center">
                <div class="col">
                    <nav class="mb-2" aria-label="breadcrumb">
                        <ol class="breadcrumb breadcrumb-sa-simple">
                            <?php echo Breadcrumbs::widget([
                                'itemTemplate' => '<li class="breadcrumb-item">{link}</li>',
                                'homeLink' => [
                                    'label' => Yii::t('app', 'Home'),
                                    'url' => Yii::$app->homeUrl,
                                ],
                                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                            ]);
                            ?>
                        </ol>
                    </nav>
                </div>
                <div class="col-auto d-flex">
                    <?= Html::a(Yii::t('app', 'Звіт за Період'), Url::to(['report/period-report']), ['class' => 'btn btn-secondary me-3']) ?>
                    <?= Html::a(Yii::t('app', 'Звіт по Prom'), Url::to(['report/prom-report']), ['class' => 'btn btn-prom me-3']) ?>
                    <?= Html::a(Yii::t('app', 'Таблиця'), Url::to(['index']), ['class' => 'btn btn-primary me-3']) ?>
                </div>
            </div>
        </div>
        <div class="sa-invoice__card">
            <div class="sa-invoice__header">
                <div class="sa-invoice__meta">
                    <div class="sa-invoice__title title-report mb-5">Звіт по Рекламі</div>
                    <div class="sa-invoice__meta-items">
                        <form action="advertising-report" method="get">
                            <span style="margin-right: 8px;">Початок:</span>
                            <label for="periodStart"></label>
                            <input type="date" id="periodStart" name="periodStart"
                                   value="<?php echo htmlspecialchars($periodStart); ?>" required>
                            <br/>
                            <br/>
                            <span style="margin-right: 20px;">Кінець:  </span>
                            <label for="periodEnd"></label>
                            <input type="date" id="periodEnd" name="periodEnd"
                                   value="<?php echo htmlspecialchars($periodEnd); ?>" required>
                            <br/>
                            <br/>
                            <span style="margin-right: 11px;">Бютжет:  </span>
                            <label for="budget"></label>
                            <input type="number" id="budget" name="budget"
                                   value="<?php echo htmlspecialchars($budget); ?>" step="0.01" style="width: 137px;" required>
                            <br/>
                            <br/>
                            <br/>
                            <input type="submit" value="Отправить">
                        </form>
                    </div>
                </div>
                <div class="sa-invoice__logo">
                    <!-- invoice-logo -->
                    <div class="sa-invoice-logo">
                        <div class="sa-invoice-logo__body">
                            <div class="sa-invoice-logo__letters">
                                <svg xmlns="http://www.w3.org/2000/svg" width="158" height="26" viewBox="0 0 158 26">
                                    <path
                                            d="M156.8,26h-2.3c-0.7,0-1.4-0.4-1.6-1.1l-2.4-6.7c0-0.1-0.1-0.1-0.2-0.1h-7.5c-0.1,0-0.2,0.1-0.2,0.1l-2.4,6.7
                            c-0.2,0.7-0.9,1.1-1.6,1.1h-2.3c-0.8,0-1.4-0.8-1.1-1.6l8.3-23.3c0.2-0.7,0.9-1.1,1.6-1.1h2.9c0.7,0,1.4,0.4,1.6,1.1l8.3,23.3
                            C158.2,25.2,157.6,26,156.8,26z M148.5,12.7l-1.8-4.9c-0.1-0.2-0.3-0.2-0.4,0l-1.8,4.9c0,0.1,0.1,0.3,0.2,0.3h3.5
                            C148.4,13,148.5,12.9,148.5,12.7z M130.5,26h-2.4c-0.5,0-1-0.3-1.3-0.8l-4.2-7.3l-2.6,4.5v2c0,0.8-0.7,1.5-1.5,1.5h-2
                            c-0.8,0-1.5-0.7-1.5-1.5v-23c0-0.8,0.7-1.5,1.5-1.5h2c0.8,0,1.5,0.7,1.5,1.5v11l6.8-11.8c0.3-0.5,0.8-0.8,1.3-0.8h2.4
                            c1.2,0,1.9,1.3,1.3,2.3L125.5,13l6.3,10.8C132.4,24.8,131.6,26,130.5,26z M104,15.8v8.7c0,0.8-0.7,1.5-1.5,1.5h-2
                            c-0.8,0-1.5-0.7-1.5-1.5v-8.7l-0.4-0.7L91.2,2.3c-0.6-1,0.2-2.3,1.3-2.3h2.3c0.5,0,1,0.3,1.3,0.8l5.4,9.3l5.4-9.3
                            c0.3-0.5,0.8-0.8,1.3-0.8h2.3c1.2,0,1.9,1.3,1.3,2.3L104,15.8z M79,26c-7.2,0-13-5.8-13-13c0-7.2,5.8-13,13-13c7.2,0,13,5.8,13,13
                            C92,20.2,86.2,26,79,26z M79,5c-4.4,0-8,3.6-8,8s3.6,8,8,8s8-3.6,8-8S83.4,5,79,5z M62.8,23.8c0.6,1-0.1,2.3-1.3,2.3h-2.3
                            c-0.5,0-1-0.3-1.3-0.8L53.7,18H49v6.5c0,0.8-0.7,1.5-1.5,1.5h-2c-0.8,0-1.5-0.7-1.5-1.5v-23C44,0.7,44.7,0,45.5,0H54c5,0,9,4,9,9
                            c0,3.2-1.7,6.1-4.3,7.7L62.8,23.8z M54,5h-4c-0.6,0-1,0.4-1,1v6c0,0.6,0.4,1,1,1h4c2.2,0,4-1.8,4-4S56.2,5,54,5z M39.5,5H33v19.5
                            c0,0.8-0.7,1.5-1.5,1.5h-2c-0.8,0-1.5-0.7-1.5-1.5V5h-6.5C20.7,5,20,4.3,20,3.5v-2C20,0.7,20.7,0,21.5,0h18C40.3,0,41,0.7,41,1.5v2
                            C41,4.3,40.3,5,39.5,5z M16.5,8h-2.3c-0.6,0-1.1-0.4-1.4-1c-0.5-1.2-2-2-3.8-2C6.8,5,5,6.3,5,8c0,0.9,0.6,1.8,1.5,2.3
                            c0.2,0.1,0.5,0.3,0.7,0.4C8.1,11,8.4,12,8,12.8l-1,1.7c-0.4,0.7-1.2,0.9-1.9,0.6C3.9,14.7,2.8,13.9,2,13c-1.2-1.4-2-3.1-2-5
                            c0-4.4,4-8,9-8c4.3,0,8,2.6,9,6.2C18.2,7.1,17.5,8,16.5,8z M1.5,18h2.3c0.6,0,1.1,0.4,1.4,1c0.5,1.2,2,2,3.8,2c2.2,0,4-1.3,4-3
                            c0-0.9-0.6-1.8-1.5-2.3c-0.2-0.1-0.5-0.3-0.7-0.4C9.9,15,9.6,14,10,13.2l1-1.7c0.4-0.7,1.2-0.9,1.9-0.6c1.2,0.5,2.3,1.3,3.1,2.2
                            c1.2,1.4,2,3.1,2,5c0,4.4-4,8-9,8c-4.3,0-8-2.6-8.9-6.2C-0.2,18.9,0.6,18,1.5,18z"
                                    ></path>
                                </svg>
                            </div>
                            <div class="sa-invoice-logo__ribbon">
                                <div class="sa-invoice-logo__ribbon-start">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="20" viewBox="0 0 4 20">
                                        <path
                                                d="M4,0v20H1.5C0.7,20,0,19.1,0,18s0.7-2,1.5-2S3,15.1,3,14s-0.7-2-1.5-2S0,11.1,0,10s0.7-2,1.5-2S3,7.1,3,6S2.3,4,1.5,4S0,3.1,0,2s0.7-2,1.5-2H4z"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="sa-invoice-logo__ribbon-middle">eCommerce  Admin  Template</div>
                                <div class="sa-invoice-logo__ribbon-end">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="4" height="20" viewBox="0 0 4 20">
                                        <path
                                                d="M4,0v20H1.5C0.7,20,0,19.1,0,18s0.7-2,1.5-2S3,15.1,3,14s-0.7-2-1.5-2S0,11.1,0,10s0.7-2,1.5-2S3,7.1,3,6S2.3,4,1.5,4S0,3.1,0,2s0.7-2,1.5-2H4z"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="sa-invoice-logo__ribbon-drawer">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="24" viewBox="0 0 32 24">
                                        <path
                                                class="sa-roller-sponge"
                                                d="M4.5,24h-3C0.7,24,0,23.3,0,22.5v-17C0,4.7,0.7,4,1.5,4h3C5.3,4,6,4.7,6,5.5v17C6,23.3,5.3,24,4.5,24z"
                                        ></path>
                                        <path class="sa-roller-stripes"
                                              d="M0,20l6-2v2l-6,2V20z M0,14l6-2v2l-6,2V14z M0,8l6-2v2l-6,2V8z"></path>
                                        <path
                                                class="sa-roller-handle"
                                                d="M30.8,18H20c0,0.6-0.4,1-1,1h-1c-0.6,0-1-0.4-1-1v-2h-2.6c-0.7,0-1.3-0.4-1.4-1.1L9.2,2H4v2H2V1.5
                                C2,0.7,2.7,0,3.5,0h6.1c0.7,0,1.3,0.4,1.4,1.1L14.8,14H17v-1c0-0.6,0.4-1,1-1h1c0.6,0,1,0.4,1,1h10.8c0.7,0,1.2,0.5,1.2,1.2v2.6
                                C32,17.5,31.5,18,30.8,18z"
                                        ></path>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- invoice-logo / end -->
                </div>
            </div>
            <div class="sa-invoice__table-container">
                <h4> Реклама замовлення за період: </h4>
                <br>
                <table class="sa-invoice__table">
                    <thead class="sa-invoice__table-head">
                    <tr>
                        <th class="sa-invoice__table-column--type--product">Відділ / Пакування</th>
                        <th class="sa-invoice__table-column--type--quantity">К-ть</th>
                        <th class="sa-invoice__table-column--type--price">Сума</th>
                        <th class="sa-invoice__table-column--type--price">Собі-ть</th>
                        <th class="sa-invoice__table-column--type--price">Знижки</th>
                        <th class="sa-invoice__table-column--type--price">Доставка</th>
                        <th class="sa-invoice__table-column--type--price">Платформи</th>
                        <th class="sa-invoice__table-column--type--total">Приб.</th>
                    </tr>
                    </thead>
                    <tbody class="sa-invoice__table-body">
                    <tr>
                        <td class="sa-invoice__table-column--type--product">Фермерський Відділ</td>

                        <td class="sa-invoice__table-column--type--quantity"><?= $bigQty ?></td>
                        <td class="sa-invoice__table-column--type--price"><?= Yii::$app->formatter->asDecimal($bigSum, 2) ?>
                            <span class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigIncomingPriceSum, 2) ?>
                            <span class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigDiscount, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol"></span>-<?= Yii::$app->formatter->asDecimal($bigDelivery, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigPlatform, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--total"><?= Yii::$app->formatter->asDecimal($bigProfit, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                    </tr>
                    <tr>
                        <td class="sa-invoice__table-column--type--product">Дрібна фасовка</td>
                        <td class="sa-invoice__table-column--type--quantity"><?= $smallQty ?></td>
                        <td class="sa-invoice__table-column--type--price"><?= Yii::$app->formatter->asDecimal($smallSum, 2) ?>
                            <span class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($smallIncomingPriceSum, 2) ?>
                            <span class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($smallDiscount, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($smallDelivery, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--price text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($smallPlatform, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                        <td class="sa-invoice__table-column--type--total"><?= Yii::$app->formatter->asDecimal($smallProfit, 2) ?>
                            <span
                                    class="sa-price__symbol"></span></td>
                    </tr>
                    </tbody>
                    <tbody class="sa-invoice__table-totals">
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Кількість замовлень</th>
                        <td class="sa-invoice__table-column--type--total"><?= $bigQty + $smallQty ?></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Сума Продажів</th>
                        <td class="sa-invoice__table-column--type--total"><?= Yii::$app->formatter->asDecimal($bigSum + $smallSum, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Ціна кліента</th>
                        <td class="sa-invoice__table-column--type--total"><?= Yii::$app->formatter->asDecimal($clientPrice, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Собівартість</th>
                        <td class="sa-invoice__table-column--type--total text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigIncomingPriceSum + $smallIncomingPriceSum, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Знижки</th>
                        <td class="sa-invoice__table-column--type--total text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigDiscount + $smallDiscount, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Доставка</th>
                        <td class="sa-invoice__table-column--type--total text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigDelivery + $smallDelivery, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Платформи</th>
                        <td class="sa-invoice__table-column--type--total text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($bigPlatform + $smallPlatform, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    <tr>
                        <th class="sa-invoice__table-column--type--header" colspan="6">Бютжет</th>
                        <td class="sa-invoice__table-column--type--total text-danger"><span
                                    class="sa-price__symbol">-</span><?= Yii::$app->formatter->asDecimal($budget, 2) ?>
                            <span
                                    class="sa-price__symbol"> ₴</span></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="sa-invoice__total">
                <div class="sa-invoice__total-title">Загальний Прибуток:</div>
                <div class="sa-invoice__total-value"><?= Yii::$app->formatter->asDecimal(($bigProfit + $smallProfit) - $budget, 2) ?>
                    <span
                            class="sa-price__symbol"> ₴</span></div>
            </div>
            <div class="sa-invoice__disclaimer">
                Information on technical characteristics, the delivery set, the country of manufacture and the
                appearance of the goods is for
                reference only and is based on the latest information available at the time of publication.
            </div>
        </div>
    </div>
</div>
<style>
    .title-report {
        padding: 0 10px;
        border-radius: 1000px;
        position: relative;
        background: rgba(4, 182, 48, 0.73);
        color: #eff2f4;
        font-weight: 700;
    }
</style>
