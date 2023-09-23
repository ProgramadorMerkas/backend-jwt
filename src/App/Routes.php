<?php

declare(strict_types=1); 

#$app->get('/', 'App\Controller\Home:getHelp');
//$app->get('/status', 'App\Controller\Home:getStatus');
$app->post('/create_trade' , App\Controller\Create_trade\Create::class);
#$app->get('/aliados_merkas', App\Controller\Aliados_merkas\GetAll::class);
$app->post('/aliados_merkas', App\Controller\Aliados_merkas\Create::class);
#$app->get('/aliados_merkas/{id}', App\Controller\Aliados_merkas\GetOne::class);
//$app->put('/aliados_merkas/{id}', App\Controller\Aliados_merkas\Update::class);
$app->get('/aliados_merkas/nit/{nit}' , App\Controller\Aliados_merkas\GetNit::class); //buscar si existe el nit
//$app->put('/aliados_merkas/edit/{id}' , App\Controller\Aliados_merkas\UpdateAliado::class);

//$app->post('/aliados_merkas/img' , App\Controller\Aliados_merkas\UpdateImages::class);
#$app->delete('/aliados_merkas/{id}', App\Controller\Aliados_merkas\Delete::class);

#$app->get('/usuarios', App\Controller\Usuarios\GetAll::class);
//$app->post('/usuarios', App\Controller\Usuarios\Create::class);
$app->post('/usuarios/mail', App\Controller\Usuarios\GetMail::class); //validar si un mail ya existe
//$app->put('/usuarios/{id}', App\Controller\Usuarios\Update::class);
$app->put('/usuarios/gps/{id}' , 'App\Controller\Usuarios\Update:geolocalizacion');//actualizar gps de un user
#$app->delete('/usuarios/{id}', App\Controller\Usuarios\Delete::class);

#$app->get('/municipios', App\Controller\Municipios\GetAll::class);
#$app->post('/municipios', App\Controller\Municipios\Create::class);
//$app->get('/municipios/findbyiddepartamento/{id}', App\Controller\Municipios\getAllMunicipiosByDepartamento::class);
#$app->put('/municipios/{id}', App\Controller\Municipios\Update::class);
#$app->delete('/municipios/{id}', App\Controller\Municipios\Delete::class);

//$app->get('/departamentos', App\Controller\Departamentos\GetAll::class);
#$app->post('/departamentos', App\Controller\Departamentos\Create::class);
#$app->get('/departamentos/{id}', App\Controller\Departamentos\GetOne::class);
#$app->put('/departamentos/{id}', App\Controller\Departamentos\Update::class);
#$app->delete('/departamentos/{id}', App\Controller\Departamentos\Delete::class);

#$app->get('/aliados_merkas_categorias', App\Controller\Aliados_merkas_categorias\GetAll::class);
#$app->post('/aliados_merkas_categorias', App\Controller\Aliados_merkas_categorias\Create::class);
$app->get('/aliados_merkas_categorias/tipo/{id}', App\Controller\Aliados_merkas_categorias\FindByTipo::class);
#$app->put('/aliados_merkas_categorias/{id}', App\Controller\Aliados_merkas_categorias\Update::class);
#$app->delete('/aliados_merkas_categorias/{id}', App\Controller\Aliados_merkas_categorias\Delete::class);

#$app->get('/desarrolladores', App\Controller\Desarrolladores\GetAll::class);
//$app->post('/desarrolladores', App\Controller\Desarrolladores\Create::class);
#$app->get('/desarrolladores/{id}', App\Controller\Desarrolladores\GetOne::class);
#$app->put('/desarrolladores/{id}', App\Controller\Desarrolladores\Update::class);
#$app->delete('/desarrolladores/{id}', App\Controller\Desarrolladores\Delete::class);

$app->get('/aliados_merkas_rangos', App\Controller\Aliados_merkas_rangos\GetAll::class);
#$app->post('/aliados_merkas_rangos', App\Controller\Aliados_merkas_rangos\Create::class);
#$app->get('/aliados_merkas_rangos/{id}', App\Controller\Aliados_merkas_rangos\GetOne::class);
#$app->put('/aliados_merkas_rangos/{id}', App\Controller\Aliados_merkas_rangos\Update::class);
#$app->delete('/aliados_merkas_rangos/{id}', App\Controller\Aliados_merkas_rangos\Delete::class);

#$app->get('/aliados_merkas_categorias_relacion', App\Controller\Aliados_merkas_categorias_relacion\GetAll::class);
#$app->post('/aliados_merkas_categorias_relacion', App\Controller\Aliados_merkas_categorias_relacion\Create::class);
#$app->get('/aliados_merkas_categorias_relacion/{id}', App\Controller\Aliados_merkas_categorias_relacion\GetOne::class);
#$app->put('/aliados_merkas_categorias_relacion/{id}', App\Controller\Aliados_merkas_categorias_relacion\Update::class);
#$app->delete('/aliados_merkas_categorias_relacion/{id}', App\Controller\Aliados_merkas_categorias_relacion\Delete::class);

#$app->get('/aliados_merkas_sucursales', App\Controller\Aliados_merkas_sucursales\GetAll::class);
#$app->post('/aliados_merkas_sucursales', App\Controller\Aliados_merkas_sucursales\Create::class);
#$app->get('/aliados_merkas_sucursales/{id}', App\Controller\Aliados_merkas_sucursales\GetOne::class);
//$app->put('/aliados_merkas_sucursales/edit/{id}', App\Controller\Aliados_merkas_sucursales\Update::class);
#$app->delete('/aliados_merkas_sucursales/{id}', App\Controller\Aliados_merkas_sucursales\Delete::class);

//$app->get('/settings', App\Controller\Settings\GetAll::class);
//$app->post('/settings', App\Controller\Settings\Create::class);
//$app->get('/settings/{id}', App\Controller\Settings\GetOne::class);
//$app->put('/settings/{id}', App\Controller\Settings\Update::class);
//$app->delete('/settings/{id}', App\Controller\Settings\Delete::class);

//$app->get('/bancos', App\Controller\Bancos\GetAll::class);
//$app->post('/bancos', App\Controller\Bancos\Create::class);
//$app->get('/bancos/{id}', App\Controller\Bancos\GetOne::class);
//$app->put('/bancos/{id}', App\Controller\Bancos\Update::class);
//$app->delete('/bancos/{id}', App\Controller\Bancos\Delete::class);
