<?php

declare(strict_types=1);

namespace App\Controller\Bancos;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class GetAll extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $bancoss = $this->getBancosService()->getAll();

        return $response->withJson($bancoss);
    }
}
