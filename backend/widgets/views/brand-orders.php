<?php
//exit('<pre>'.print_r($brands,true).'</pre>');
?>

<div class="col-12 col-xxl-3 d-flex">
    <div
            class="card flex-grow-1 saw-chart-circle"
            data-sa-data='<?= $carts ?>'
            data-sa-container-query='{"600":"saw-chart-circle--size--lg"}'
    >
        <div class="sa-widget-header saw-chart-circle__header">
            <h2 class="sa-widget-header__title">Продаж по брендах</h2>
            <div class="sa-widget-header__actions">
                <div class="dropdown">
                    <button
                            type="button"
                            class="btn btn-sm btn-sa-muted d-block"
                            id="widget-context-menu-7"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="More"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" width="3" height="13" fill="currentColor">
                            <path
                                    d="M1.5,8C0.7,8,0,7.3,0,6.5S0.7,5,1.5,5S3,5.7,3,6.5S2.3,8,1.5,8z M1.5,3C0.7,3,0,2.3,0,1.5S0.7,0,1.5,0 S3,0.7,3,1.5S2.3,3,1.5,3z M1.5,10C2.3,10,3,10.7,3,11.5S2.3,13,1.5,13S0,12.3,0,11.5S0.7,10,1.5,10z"
                            ></path>
                        </svg>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="widget-context-menu-7">
                        <li><a class="dropdown-item" href="/#">Settings</a></li>
                        <li><a class="dropdown-item" href="/#">Move</a></li>
                        <li>
                            <hr class="dropdown-divider"/>
                        </li>
                        <li><a class="dropdown-item text-danger" href="/#">Remove</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="saw-chart-circle__body">
            <div class="saw-chart-circle__container">
                <canvas></canvas>
            </div>
        </div>
        <div class="sa-widget-table saw-chart-circle__table">
            <table>
                <thead>
                <tr>
                    <th>Бренд</th>
                    <th class="text-center">Товарів</th>
                    <th class="text-end">Сумма</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 0;
                foreach ($brands as $brand): ?>
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="saw-chart-circle__symbol"
                                         style="--saw-chart-circle__symbol--color: <?= $brand['color'] ?>"></div>
                                    <div class="ps-2"><?= $brand['label'] ?></div>
                                </div>
                            </td>
                            <td class="text-center"><span
                                        class="sa-nav__menu-item-badge badge badge-sa-pill badge-sa-theme-user"><?= $brand['orders'] ?></span>
                            </td>
                            <td class="text-end">
                                <div class="sa-price">
                                    <span class="sa-price__integer"><?= Yii::$app->formatter->asCurrency($brand['value'], 'UAH') ?></span>
                                </div>
                            </td>
                        </tr>
                        <?php $i++; ?>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
