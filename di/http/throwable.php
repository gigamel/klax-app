<?php

declare(strict_types=1);

use App\Throwable\DebugThrowableHandler;
use Klax\Http\Runner\Contract\ThrowableHandlerInterface;
use Klax\Renderer\Contract\ResponseRendererInterface;
use Psr\Container\ContainerInterface;

return [
    Throwable::class => static fn(ContainerInterface $container): ThrowableHandlerInterface => new DebugThrowableHandler(
        $container->get(ResponseRendererInterface::class),
    ),
];
