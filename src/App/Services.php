<?php

declare(strict_types=1);

$container['aliados_merkas_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkasService {
    return new App\Service\Aliados_merkasService($container['aliados_merkas_repository'],
    $container['usuarios_repository'], $container['desarrolladores_repository'] , $container['aliados_merkas_categorias_relacion_repository']
, $container['aliados_merkas_sucursales_repository'] , $container['aliados_merkas_rangos_repository'] , $container['settings_repository']);
};

$container['usuarios_service'] = static function (Pimple\Container $container): App\Service\UsuariosService {
    return new App\Service\UsuariosService($container['usuarios_repository'] , $container['aliados_merkas_repository'] , $container['settings_repository'] , 
$container["mail_send_service"]);
};

$container['municipios_service'] = static function (Pimple\Container $container): App\Service\MunicipiosService {
    return new App\Service\MunicipiosService($container['municipios_repository']);
};

$container['departamentos_service'] = static function (Pimple\Container $container): App\Service\DepartamentosService {
    return new App\Service\DepartamentosService($container['departamentos_repository']);
};

$container['aliados_merkas_categorias_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkas_categoriasService {
    return new App\Service\Aliados_merkas_categoriasService($container['aliados_merkas_categorias_repository']);
};

$container['desarrolladores_service'] = static function (Pimple\Container $container): App\Service\DesarrolladoresService {
    return new App\Service\DesarrolladoresService($container['desarrolladores_repository']);
};

$container['aliados_merkas_rangos_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkas_rangosService {
    return new App\Service\Aliados_merkas_rangosService($container['aliados_merkas_rangos_repository']);
};

$container['aliados_merkas_categorias_relacion_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkas_categorias_relacionService {
    return new App\Service\Aliados_merkas_categorias_relacionService($container['aliados_merkas_categorias_relacion_repository']);
};

$container['aliados_merkas_sucursales_service'] = static function (Pimple\Container $container): App\Service\Aliados_merkas_sucursalesService {
    return new App\Service\Aliados_merkas_sucursalesService($container['aliados_merkas_sucursales_repository'] , $container['aliados_merkas_repository']);
};

$container['settings_service'] = static function (Pimple\Container $container): App\Service\SettingsService {
    return new App\Service\SettingsService($container['settings_repository']);
};

$container['mail_send_service'] = static function (Pimple\Container $container): App\Service\MailSendService {
    return new App\Service\MailSendService($container['settings_repository']);
};

$container['bancos_service'] = static function (Pimple\Container $container): App\Service\BancosService {
    return new App\Service\BancosService($container['bancos_repository']);
};

$container['create_trade'] = static function (Pimple\Container $container): App\Service\TradeService {
    return new \App\Service\TradeService($container['aliados_merkas_repository'],
    $container['usuarios_repository'], $container['desarrolladores_repository'] , $container['aliados_merkas_categorias_relacion_repository']
, $container['aliados_merkas_sucursales_repository'] , $container['aliados_merkas_rangos_repository'] , $container['settings_repository'] 
, $container['usuarios_service'] , $container['aliados_merkas_service']);
};
