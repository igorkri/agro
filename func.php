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

function log_error($message, $file = 'error_log.txt') {
    $timestamp = date('Y-m-d H:i:s');
    $logMessage = "[$timestamp] $message" . PHP_EOL;
    file_put_contents($file, $logMessage, FILE_APPEND);
}

function format_datetime($datetime, $format = 'Y-m-d H:i:s') {
    return date($format, strtotime($datetime));
}

function class_exists_safe($className) {
    return class_exists($className, false);
}

function get_post_data($key, $filter = FILTER_SANITIZE_STRING) {
    return filter_input(INPUT_POST, $key, $filter);
}

function is_json($string) {
    json_decode($string);
    return json_last_error() === JSON_ERROR_NONE;
}
