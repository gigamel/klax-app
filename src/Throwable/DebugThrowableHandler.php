<?php

declare(strict_types=1);

namespace App\Throwable;

use Klax\Http\Runner\Contract\ThrowableHandlerInterface;
use Klax\Renderer\Contract\ResponseRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

readonly class DebugThrowableHandler implements ThrowableHandlerInterface
{
    public function __construct(
        private ResponseRendererInterface $responseRenderer,
    ) {

    }

    public function handle(ServerRequestInterface $request, Throwable $throwable): ResponseInterface
    {
        return $this->responseRenderer->render(
            __DIR__ . '/../../view/throwable.php',
            ['throwable' => $throwable],
            500,
        );
    }
}
