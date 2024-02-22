<?php

use yii\helpers\VarDumper;

function debug_vd($arr)
{
    VarDumper::dump($arr, 10, true);
}

function debug_pr($arr)
{
    exit('<pre>'.print_r($arr,true).'</pre>');
}
