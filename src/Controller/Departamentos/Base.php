<?php

declare(strict_types=1);

namespace App\Controller\Departamentos;

use App\Service\DepartamentosService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getDepartamentosService(): DepartamentosService
    {
        return $this->container->get('departamentos_service');
    }
}
