<?php

declare(strict_types=1);

namespace App\Controller\Usuarios;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
 
        $uploadedFiles = $request->getUploadedFiles(); 

        $usuarios = $this->getUsuariosService()->create($input , $uploadedFiles);


        return $response->withJson($usuarios, StatusCodeInterface::STATUS_CREATED);
    }
}
