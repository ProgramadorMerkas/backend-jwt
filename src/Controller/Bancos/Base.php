<?php

declare(strict_types=1);

namespace App\Controller\Bancos;

use App\Service\BancosService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getBancosService(): BancosService
    {
        return $this->container->get('bancos_service');
    }
}
