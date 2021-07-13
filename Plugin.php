<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators;

use Illuminate\Contracts\Events\Dispatcher;
use System\Classes\PluginBase;
use Vdlp\SitemapGenerators\Classes\EventSubscribers\SitemapSubscriber;

final class Plugin extends PluginBase
{
    public $require = [
        'Vdlp.Sitemap',
    ];

    public function pluginDetails(): array
    {
        return [
            'name' => 'Sitemap Generators',
            'description' => 'Provides Sitemap Generators for the Vdlp.Sitemap plugin',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-leaf',
        ];
    }

    public function register(): void
    {
        $this->app->register(ServiceProvider::class);

        /** @var Dispatcher $events */
        $events = $this->app->make(Dispatcher::class);
        $events->subscribe($this->app->make(SitemapSubscriber::class));
    }
}
