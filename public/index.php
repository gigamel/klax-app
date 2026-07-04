<?php

declare(strict_types=1);

use Klax\HttpKernel\Runner\HttpKernelRunner;

require __DIR__ . '/../vendor/autoload.php';

ini_set('display_errors', 1);
error_reporting(E_ALL);

HttpKernelRunner::withDefaultContainer(
    preBootFilesMap: __DIR__ . '/../preboot/http.php',
    servicesFilesMap: __DIR__ . '/../config/http/kernel.php',
    routesFilesMap: __DIR__ . '/../config/routing.php',
)->run();
