<?php

declare(strict_types=1);

namespace App\Controller\Desarrolladores;

use App\Service\DesarrolladoresService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getDesarrolladoresService(): DesarrolladoresService
    {
        return $this->container->get('desarrolladores_service');
    }
}
