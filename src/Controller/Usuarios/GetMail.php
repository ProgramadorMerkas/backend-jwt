<?php

declare(strict_types=1);

namespace App\Controller\Usuarios;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetMail extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {

        $input = (array) $request->getParsedBody(); 
        
        $usuarios = $this->getUsuariosService()->getMail((array) $input);

        return $response->withJson($usuarios);
    }
}
