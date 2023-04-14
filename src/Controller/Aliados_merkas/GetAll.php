<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $aliados_merkass = $this->getAliados_merkasService()->getAll();

        return $response->withJson($aliados_merkass);
    }
}
