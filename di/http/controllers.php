<?php

declare(strict_types=1);

use App\Controller\PageController;
use Klax\Renderer\Contract\ResponseRendererInterface;
use Psr\Container\ContainerInterface;

return [
    PageController::class => static fn (ContainerInterface $container): PageController
        => new PageController($container->get(ResponseRendererInterface::class)),
];
