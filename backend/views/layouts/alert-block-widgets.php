<?php

use kartik\alert\AlertBlock;
use kartik\growl\Growl;

echo AlertBlock::widget([
    'type' => AlertBlock::TYPE_GROWL,
    'useSessionFlash' => true,
    'delay' => 1000,
    'alertSettings' => [
        'success' => [
            'type' => Growl::TYPE_SUCCESS,
            'icon' => 'fas fa-check-circle',
            'iconOptions' => ['class' => 'icon-options'],
            'bodyOptions' => ['class' => 'body-options'],
            'closeButton' => [
                'style' => 'display: none',
            ],
            'pluginOptions' => [
                'z_index' => 3031,
                'timer' => 1000,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right'
                ]
            ]
        ],
        'danger' => [
            'type' => Growl::TYPE_DANGER,
            'icon' => 'fas fa-check-circle',
            'iconOptions' => ['class' => 'icon-options'],
            'bodyOptions' => ['class' => 'body-options;'],
            'closeButton' => [
                'style' => 'display: none',
            ],
            'pluginOptions' => [
                'z_index' => 3031,
                'timer' => 1000,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right'
                ]
            ]
        ],
        'warning' => [
            'type' => Growl::TYPE_WARNING,
            'icon' => 'fas fa-check-circle',
            'iconOptions' => ['class' => 'icon-options'],
            'bodyOptions' => ['class' => 'body-options'],
            'closeButton' => [
                'style' => 'display: none',
            ],
            'pluginOptions' => [
                'z_index' => 3031,
                'timer' => 1000,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right'
                ]
            ]
        ],
        'info' => [
            'type' => Growl::TYPE_INFO,
            'icon' => 'fas fa-check-circle',
            'iconOptions' => ['class' => 'icon-options'],
            'bodyOptions' => ['class' => 'body-options'],
            'closeButton' => [
                'style' => 'display: none',
            ],
            'pluginOptions' => [
                'z_index' => 3031,
                'timer' => 1000,
                'placement' => [
                    'from' => 'top',
                    'align' => 'right'
                ]
            ]
        ]
    ]
]);
?>
<style>
    .icon-options {
        font-size: 26px;
    }
    .body-options {
        font-size: 20px;
        font-weight: bold;
    }
</style>
