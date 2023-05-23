<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_sucursales;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $aliados_merkas_sucursaless = $this->getAliados_merkas_sucursalesService()->getAll();

        return $response->withJson($aliados_merkas_sucursaless);
    }
}
