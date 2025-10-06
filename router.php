<?php
// Serve requested file if it exists
if (php_sapi_name() == 'cli-server') {
    $file = $_SERVER['DOCUMENT_ROOT'] . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if (is_file($file)) {
        return false;
    }
}
// Otherwise serve index.html
include_once "index.html";
