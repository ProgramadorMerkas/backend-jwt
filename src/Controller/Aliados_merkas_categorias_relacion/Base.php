<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_categorias_relacion;

use App\Service\Aliados_merkas_categorias_relacionService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getAliados_merkas_categorias_relacionService(): Aliados_merkas_categorias_relacionService
    {
        return $this->container->get('aliados_merkas_categorias_relacion_service');
    }
}
