<?php

declare(strict_types=1);

$container['aliados_merkas_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkasService {
    return new App\Service\Aliados_merkasService($container['aliados_merkas_repository']);
};
