<?php

declare(strict_types=1);

namespace App\Controller;

use Klax\Renderer\Contract\ResponseRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

final readonly class PageController implements RequestHandlerInterface
{
    public function __construct(
        private ResponseRendererInterface $responseRenderer,
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        return $this->responseRenderer->render(
            __DIR__ . '/../../view/default.php',
            [
                'message' => 'Hello world!',
            ],
        );
    }
}
