<?php

declare(strict_types=1);

namespace App\Controller\Settings;

use App\CustomResponse as Response;
use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ServerRequestInterface as Request;

final class Create extends Base
{
    public function __invoke(Request $request, Response $response): Response
    {
        $input = (array) $request->getParsedBody();
        $settings = $this->getSettingsService()->create($input);

        return $response->withJson($settings, StatusCodeInterface::STATUS_CREATED);
    }
}
