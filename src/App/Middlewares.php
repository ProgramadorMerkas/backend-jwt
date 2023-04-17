<?php

declare(strict_types=1);

use Slim\App;
use Slim\Exception\HttpBadRequestException;
return static function (App $app, Closure $customErrorHandler): void {

    $path = $_SERVER['SLIM_BASE_PATH'] ?? '';
    $app->setBasePath($path);
    $app->addRoutingMiddleware();
    $app->addBodyParsingMiddleware();

    //validacion de middleware
    $app->add(function ($request , $handler){
        if (!$request->hasHeader('x-token')) {

            throw new HttpBadRequestException($request, "token no encontrado");
        }
        if ($request->getHeaderLine('x-token') !== '$?¡@==¡5525125c5f20878be92b9e7a8e687562c53f5610') {
            throw new HttpBadRequestException($request, "token incorrecto");
        }
        $response = $handler->handle($request);
        return $response;
    });

    $displayError = filter_var(
        $_SERVER['DISPLAY_ERROR_DETAILS'] ?? false,
        FILTER_VALIDATE_BOOLEAN
    );
    $errorMiddleware = $app->addErrorMiddleware($displayError, true, true);
    $errorMiddleware->setDefaultErrorHandler($customErrorHandler);
};
