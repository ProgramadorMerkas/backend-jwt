<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Fig\Http\Message\StatusCodeInterface;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $aliados_merkas = $this->getAliados_merkasService()->create($input);

        return $response->withJson($aliados_merkas, StatusCodeInterface::STATUS_CREATED);
    }
}
