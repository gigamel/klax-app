<?php

declare(strict_types=1);

namespace App\Render;

use Klax\Http\Message\Response;
use Klax\Http\Protocol\StatusCode;
use Klax\Renderer\Contract\RendererInterface;
use Klax\Renderer\Contract\ResponseRendererInterface;
use Psr\Http\Message\ResponseInterface;

readonly class ResponseRenderer implements ResponseRendererInterface
{
    // Todo: replace to PSR-17 factory
    public function __construct(
        private RendererInterface $renderer,
    ) {
    }

    public function render(
        string $view,
        array $vars = [],
        int $statusCode = StatusCode::OK,
        array $headers = [],
    ): ResponseInterface {
        $response = new Response($this->renderer->render($view, $vars), $statusCode);

        foreach ($headers as $key => $value) {
            $response = $response->withHeader($key, $value);
        }

        return $response;
    }
}
