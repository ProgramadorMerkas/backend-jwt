<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas;

use App\Service\Aliados_merkasService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getAliados_merkasService(): Aliados_merkasService
    {
        return $this->container->get('aliados_merkas_service');
    }
}
