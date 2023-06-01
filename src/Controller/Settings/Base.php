<?php

declare(strict_types=1);

namespace App\Controller\Settings;

use App\Service\SettingsService;
use Pimple\Psr11\Container;

abstract class Base
{
    protected Container $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    protected function getSettingsService(): SettingsService
    {
        return $this->container->get('settings_service');
    }
}
