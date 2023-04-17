<?php

declare(strict_types=1);

namespace App\Controller\Usuarios;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $usuarioss = $this->getUsuariosService()->getAll();

        return $response->withJson($usuarioss);
    }
}
