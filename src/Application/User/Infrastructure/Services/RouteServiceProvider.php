<?php

declare(strict_types=1);

namespace Src\Application\User\Infrastructure\Services;

use Src\Shared\Infrastructure\Services\RouteServiceProvider as ServiceProvider;

final class RouteServiceProvider extends ServiceProvider
{
    /**
     * @param $app
     */
    public function __construct($app)
    {
        $appVersion = env("APP_VERSION");
        $this->setDependency(
            'api/' . $appVersion . '/users',
            'Src\Application\User\Infrastructure\Controllers',
            'src/Application/User/Infrastructure/Routes/Api.php',
            false
        );
        parent::__construct($app);
    }
}
