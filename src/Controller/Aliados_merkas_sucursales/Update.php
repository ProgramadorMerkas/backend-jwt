<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_sucursales;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Update extends Base
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
        $aliados_merkas_sucursales = $this->getAliados_merkas_sucursalesService()->update($input, (int) $args['id']);

        return $response->withJson($aliados_merkas_sucursales);
    }
}
