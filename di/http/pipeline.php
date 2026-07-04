<?php

declare(strict_types=1);

use Klax\Http\Router\Contract\RouterInterface;
use Klax\Http\Runner\Configuration\ThrowableHandlerResolver;
use Klax\Http\Runner\Middleware\RoutingMiddleware;
use Klax\Http\Runner\Middleware\ThrowableMiddleware;
use Psr\Container\ContainerInterface;

return [
    ThrowableMiddleware::class => static fn (ContainerInterface $container): ThrowableMiddleware
        => new ThrowableMiddleware($container->get(ThrowableHandlerResolver::class)),
    RoutingMiddleware::class => static fn (ContainerInterface $container): RoutingMiddleware
        => new RoutingMiddleware($container->get(RouterInterface::class)),
];
