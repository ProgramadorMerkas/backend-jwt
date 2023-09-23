<?php

declare(strict_types=1);

$container['aliados_merkas_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkasRepository {
    return new App\Repository\Aliados_merkasRepository($container['db']);
};

$container['usuarios_repository'] = static function (Pimple\Container $container): App\Repository\UsuariosRepository {
    return new App\Repository\UsuariosRepository($container['db']);
};

$container['municipios_repository'] = static function (Pimple\Container $container): App\Repository\MunicipiosRepository {
    return new App\Repository\MunicipiosRepository($container['db']);
};

$container['departamentos_repository'] = static function (Pimple\Container $container): App\Repository\DepartamentosRepository {
    return new App\Repository\DepartamentosRepository($container['db']);
};

$container['aliados_merkas_categorias_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkas_categoriasRepository {
    return new App\Repository\Aliados_merkas_categoriasRepository($container['db']);
};

$container['desarrolladores_repository'] = static function (Pimple\Container $container): App\Repository\DesarrolladoresRepository {
    return new App\Repository\DesarrolladoresRepository($container['db']);
};

$container['aliados_merkas_rangos_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkas_rangosRepository {
    return new App\Repository\Aliados_merkas_rangosRepository($container['db']);
};

$container['aliados_merkas_categorias_relacion_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkas_categorias_relacionRepository {
    return new App\Repository\Aliados_merkas_categorias_relacionRepository($container['db']);
};

$container['aliados_merkas_sucursales_repository'] = static function (Pimple\Container $container): App\Repository\Aliados_merkas_sucursalesRepository {
    return new App\Repository\Aliados_merkas_sucursalesRepository($container['db']);
};

$container['settings_repository'] = static function (Pimple\Container $container): App\Repository\SettingsRepository {
    return new App\Repository\SettingsRepository($container['db']);
};

$container['bancos_repository'] = static function (Pimple\Container $container): App\Repository\BancosRepository {
    return new App\Repository\BancosRepository($container['db']);
};
