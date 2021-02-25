<?php

require __DIR__ . '/../vendor/autoload.php';

try {
    $bootstrap = new \App\Core\Bootstrap();

    $bootstrap->runApplication();
} catch (Exception $exception) {
    echo $exception->getMessage();
}

