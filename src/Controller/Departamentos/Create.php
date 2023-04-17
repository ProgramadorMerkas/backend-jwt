<?php

declare(strict_types=1);

namespace App\Controller\Departamentos;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $departamentos = $this->getDepartamentosService()->create($input);

        return $response->withJson($departamentos, StatusCodeInterface::STATUS_CREATED);
    }
}
