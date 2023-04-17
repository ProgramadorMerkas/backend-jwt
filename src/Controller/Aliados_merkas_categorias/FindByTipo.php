<?php

declare(strict_types=1);

namespace App\Controller\Aliados_merkas_categorias;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

final class FindByTipo extends Base
{
    /**
     * @param array<string> $args
     */
    public function __invoke(
        Request $request,
        Response $response,
        array $args
    ): Response {
        $aliados_merkas_categorias = $this->getAliados_merkas_categoriasService()->getFindByTipo((int) $args['id']);

        return $response->withJson($aliados_merkas_categorias);
    }
}
