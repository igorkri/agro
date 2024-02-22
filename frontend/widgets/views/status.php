<?php

/** @var \common\models\shop\Product $product */

?>

<div class="form-group product__option">
                                        <span class="text-success" style="font-weight: 600;padding: 3px 1px">
                                <?php
                                if ($product->status_id == 1) {
                                    echo '<i style="font-size:1rem; margin: 5px;" class="fas fa-check"></i> ' . $product->status->name;
                                } elseif ($product->status_id == 2) {
                                    echo '<i style="font-size:1rem; color: #ff0000!important; margin: 5px;" class="fas fa-ban"></i> ';
                                    echo "<span style='color: #ff0000 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 3) {
                                    echo '<i style="font-size:1rem; color: #ff8300!important; margin: 5px;" class="fas fa-truck"></i> ';
                                    echo "<span style='color: #ff8300 !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } elseif ($product->status_id == 4) {
                                    echo '<i style="font-size:1rem; color: #0331fc!important; margin: 5px;" class="fa fa-bars"></i> ';
                                    echo "<span style='color: #0331fc !important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                } else {
                                    echo "<span style='color: #060505!important;
                                                font-weight: 600;
                                                letter-spacing: 0.6px;
                                            '> " . $product->status->name . " </span>";
                                }
                                ?>
                            </span>
</div>