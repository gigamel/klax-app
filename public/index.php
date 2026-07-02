<?php

declare(strict_types=1);

use App\Kernel;

require __DIR__ . '/../vendor/autoload.php';

Kernel::withDefaultContainer()
    ->boot(__DIR__ . '/../di/kernel.php')
    ->run();
