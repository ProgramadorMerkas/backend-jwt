<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_rangos;

use App\Service\Aliados_merkas_rangosService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getAliados_merkas_rangosService(): Aliados_merkas_rangosService
    {
        return $this->container->get('aliados_merkas_rangos_service');
    }
}
