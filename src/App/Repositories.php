<?php

declare(strict_types=1);

$container['aliados_merkas_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkasRepository {
    return new App\Repository\Aliados_merkasRepository($container['db']);
};
