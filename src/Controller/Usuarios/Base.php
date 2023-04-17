<?php

declare(strict_types=1);

namespace App\Controller\Usuarios;

use App\Service\UsuariosService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getUsuariosService(): UsuariosService
    {
        return $this->container->get('usuarios_service');
    }
}
