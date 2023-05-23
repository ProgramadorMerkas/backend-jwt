<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_sucursales;

use App\Service\Aliados_merkas_sucursalesService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getAliados_merkas_sucursalesService(): Aliados_merkas_sucursalesService
    {
        return $this->container->get('aliados_merkas_sucursales_service');
    }
}
