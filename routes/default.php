<?php

declare(strict_types=1);

use App\Controller\PageController;
use Klax\Http\Router\Contract\RouteCollectionInterface;

return static function (RouteCollectionInterface $routes): void {

    $routes->add(
        'home',
        '/',
        PageController::class,
    );

};
