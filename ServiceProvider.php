<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators;

use Illuminate\Support\ServiceProvider as ServiceProviderBase;

final class ServiceProvider extends ServiceProviderBase
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/config.php' => config_path('sitemapgenerators.php'),
        ], 'config');
    }
}
