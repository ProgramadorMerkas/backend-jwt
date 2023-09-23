<?php

declare(strict_types=1);

namespace App\Controller\Create_trade;

use App\Service\TradeService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getTradeService(): TradeService
    {
        return $this->container->get('create_trade');
    }
}
 
