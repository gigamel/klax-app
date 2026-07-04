<?php

declare(strict_types=1);

use Klax\Container\Configuration\PhpArrayFileLoader;
use Klax\Container\Configuration\PhpClosureFileLoader;
use Klax\Container\Contract\Configuration\ArrayFileLoaderInterface;
use Klax\Container\Contract\Configuration\ClosureFileLoaderInterface;
use Klax\Http\Factory\ServerRequestFactory;
use Klax\Http\Router\Contract\RouteCollectionInterface;
use Klax\Http\Router\Contract\RouterInterface;
use Klax\Http\Router\RouteCollection;
use Klax\Http\Router\Router;
use Klax\HttpKernel\Runner\Contract\HttpKernelInterface;
use Klax\HttpKernel\Runner\HttpKernel;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

return [
    ArrayFileLoaderInterface::class => new PhpArrayFileLoader(),
    ClosureFileLoaderInterface::class => new PhpClosureFileLoader(),

    RouteCollectionInterface::class => RouteCollection::class,
    RouterInterface::class => static fn (ContainerInterface $container): RouterInterface
        => new Router($container->get(RouteCollectionInterface::class)),

    HttpKernelInterface::class => static function (ContainerInterface $container): HttpKernelInterface {
        return new HttpKernel(
            $container->get(ArrayFileLoaderInterface::class),
            $container->get(ClosureFileLoaderInterface::class),
            $container->get(RouteCollectionInterface::class),
        );
    },

    ServerRequestInterface::class => ServerRequestFactory::fromGlobals(), // Todo
];
