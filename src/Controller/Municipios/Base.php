<?php

declare(strict_types=1);

namespace App\Controller\Municipios;

use App\Service\MunicipiosService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getMunicipiosService(): MunicipiosService
    {
        return $this->container->get('municipios_service');
    }
}
