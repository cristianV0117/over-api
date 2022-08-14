<?php

declare(strict_types=1);

namespace Src\Status\System\Infrastructure\Services;

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
            'api/' . $appVersion . '/status',
            'Src\Status\System\Infrastructure\Controllers',
            'src/Status/System/Infrastructure/Routes/Api.php'
        );
        parent::__construct($app);
    }
}
