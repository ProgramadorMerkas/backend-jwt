<?php

declare(strict_types=1);

namespace App\Controller\Usuarios;

 
use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Update extends Base
{
    
    /**
     * @param array<string> $args
     */
   // private Container $container;

 

    public function __invoke(Request $request, Response $response, array $args): Response {
        $input = (array) $request->getParsedBody();
        $usuarios = $this->getUsuariosService()->update($input, (int) $args['id']);

        return $response->withJson($usuarios);
    }

    public  function geolocalizacion(Request $request , Response $response , array $args):Response{

        $input = (array) $request->getParsedBody(); 
        $usuario = $this->getUsuariosService()->updatedGPS($input , (int) $args['id']);

        return $response->withJson($usuario);
    }
}
