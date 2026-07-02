<?php

declare(strict_types=1);

namespace App;

use Klax\Container\Container;
use Klax\Container\Contract\ContainerInterface;

final class Kernel
{
    public function __construct(
        private ContainerInterface $container,
    ) {
    }

    public static function withDefaultContainer(): self
    {
        return new self(new Container());
    }

    public function boot(string $file): self
    {
        foreach (require_once($file) as $services) {
            foreach (require_once($services) as $id => $service) {
                $this->container->singleton($id, $service);
            }
        }

        return $this;
    }

    public function run(): void
    {
        echo 'Hello World!';
    }
}
