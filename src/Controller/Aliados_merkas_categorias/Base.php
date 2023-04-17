<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_categorias;

use App\Service\Aliados_merkas_categoriasService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getAliados_merkas_categoriasService(): Aliados_merkas_categoriasService
    {
        return $this->container->get('aliados_merkas_categorias_service');
    }
}
