<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_rangos;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $aliados_merkas_rangos = $this->getAliados_merkas_rangosService()->create($input);

        return $response->withJson($aliados_merkas_rangos, StatusCodeInterface::STATUS_CREATED);
    }
}
