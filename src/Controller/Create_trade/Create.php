<?php

declare(strict_types=1);
 
namespace App\Controller\Create_trade;

use App\CustomResponse as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Fig\Http\Message\StatusCodeInterface;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();

        $trade = $this->getTradeService()->create($input);
          
        $resp =  new \stdclass();
        $resp->response = "successful";

        return $response->withJson($resp, StatusCodeInterface::STATUS_CREATED);
    }
}
