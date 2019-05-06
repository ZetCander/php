<?php

ini_set("display_errors", 1);
error_reporting(E_ALL);

function debug($param) {
    echo '<pre>';
    var_dump($param);
    echo '</pre>';
    exit;
}

