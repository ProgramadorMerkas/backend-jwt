<?php


use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpBadRequestException;

class ValidarHeaderMiddleware {
    public function __invoke(Request $request, Response $response, $next) {
        if (!$request->hasHeader('x-token')) {
            throw new HttpBadRequestException($request, "x-token no encontrado");
        }
        $response = $next($request, $response);
        return $response;
    }
}


?>