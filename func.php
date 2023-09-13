<?php
function debug_vd($arr)
{
    \yii\helpers\VarDumper::dump($arr, 10, true);
}

function debug_pr($arr)
{
    exit('<pre>'.print_r($arr,true).'</pre>');
}
