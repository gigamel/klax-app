<?php

declare(strict_types=1);

use App\Render\ResponseRenderer;
use Klax\Renderer\Contract\RendererInterface;
use Klax\Renderer\Contract\ResponseRendererInterface;
use Klax\Renderer\PhpRenderer;
use Psr\Container\ContainerInterface;

return [
    RendererInterface::class => PhpRenderer::class,
    ResponseRendererInterface::class => static fn (ContainerInterface $container): ResponseRendererInterface
        => new ResponseRenderer($container->get(RendererInterface::class)),
];
