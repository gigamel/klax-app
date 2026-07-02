<?php

declare(strict_types=1);

use Klax\EventDispatcher\Contract\ListenerProviderInterface;
use Klax\EventDispatcher\EventDispatcher;
use Klax\EventDispatcher\ListenersProvider;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;

return [
    ListenerProviderInterface::class => ListenersProvider::class,
    EventDispatcherInterface::class => static function (ContainerInterface $container): EventDispatcherInterface {
        return new EventDispatcher($container->get(ListenerProviderInterface::class));
    },
];
