<?php

declare(strict_types=1);

namespace Src\Application\Task\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $appVersion = env("APP_VERSION");
        $this->setDependency(
            'api/' . $appVersion . '/tasks',
            'Src\Application\Task\Infrastructure\Controllers',
            'src/Application/Task/Infrastructure/Routes/Api.php',
            false
        );
        parent::__construct($app);
    }
}
