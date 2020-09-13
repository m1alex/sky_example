<?php

/**
 * index.php
 *
 * start script for application
 */

include_once __DIR__ . '/../bootstrap/bootstrap.php';

use Core\WebApp;

try {
    $app = new WebApp();
    $app->process();
} catch (Exception $e) {
    // TODO: logging with $e->getMessage()
    echo 'Sorry, there was an error... ';
}
