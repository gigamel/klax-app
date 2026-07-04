<?php

declare(strict_types=1);

use Klax\Http\Runner\Configuration\RequestHandlerResolver;
use Klax\Http\Runner\Configuration\ThrowableHandlerResolver;
use Klax\Http\Runner\Contract\EmergencyThrowableHandlerInterface;
use Klax\Http\Runner\Contract\FallbackRequestHandlerInterface;
use Klax\Http\Runner\Contract\HttpRunnerInterface;
use Klax\Http\Runner\Contract\MainRequestHandlerInterface;
use Klax\Http\Runner\Contract\SapiEmitterInterface;
use Klax\Http\Runner\FallbackRequestHandler;
use Klax\Http\Runner\HttpRunner;
use Klax\Http\Runner\MainRequestHandler;
use Klax\Http\Runner\Middleware\RoutingMiddleware;
use Klax\Http\Runner\Middleware\ThrowableMiddleware;
use Klax\Http\Skeleton\Runner\EmergencyThrowableHandler;
use Klax\Http\Skeleton\Runner\SapiEmitter;
use Psr\Container\ContainerInterface;

return [
    HttpRunnerInterface::class => static function (ContainerInterface $container): HttpRunnerInterface {
        return new HttpRunner(
            $container->get(MainRequestHandlerInterface::class),
            $container->get(SapiEmitterInterface::class),
            $container->get(EmergencyThrowableHandlerInterface::class),
        );
    },
    MainRequestHandlerInterface::class => static function (ContainerInterface $container): MainRequestHandlerInterface {
        return new MainRequestHandler(
            $container->get(FallbackRequestHandlerInterface::class),
            [
                $container->get(ThrowableMiddleware::class),
                $container->get(RoutingMiddleware::class),
            ],
        );
    },
    SapiEmitterInterface::class => SapiEmitter::class,
    EmergencyThrowableHandlerInterface::class => EmergencyThrowableHandler::class,

    RequestHandlerResolver::class => static function (ContainerInterface $container): RequestHandlerResolver {
        return new RequestHandlerResolver($container->get(ContainerInterface::class));
    },
    FallbackRequestHandlerInterface::class => static function (ContainerInterface $container): FallbackRequestHandlerInterface {
        return new FallbackRequestHandler($container->get(RequestHandlerResolver::class));
    },
    ThrowableHandlerResolver::class => static function (ContainerInterface $container): ThrowableHandlerResolver {
        return new ThrowableHandlerResolver($container->get(ContainerInterface::class));
    },
];
