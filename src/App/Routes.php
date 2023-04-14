<?php

declare(strict_types=1);

$app->get('/', 'App\Controller\Home:getHelp');
$app->get('/status', 'App\Controller\Home:getStatus');

$app->get('/aliados_merkas', App\Controller\Aliados_merkas\GetAll::class);
$app->post('/aliados_merkas', App\Controller\Aliados_merkas\Create::class);
$app->get('/aliados_merkas/{id}', App\Controller\Aliados_merkas\GetOne::class);
$app->put('/aliados_merkas/{id}', App\Controller\Aliados_merkas\Update::class);
$app->delete('/aliados_merkas/{id}', App\Controller\Aliados_merkas\Delete::class);
