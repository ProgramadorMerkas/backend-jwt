<?php

declare(strict_types=1);

namespace App\Controller\Municipios;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class getAllMunicipiosByDepartamento extends Base
{
    public function __invoke(Request $request, Response $response , $args): Response
    {
         
        $municipioss = $this->getMunicipiosService()->getAllMunicipiosByDepartamento((int) $args['id']);

        return $response->withJson($municipioss);
    }
}
