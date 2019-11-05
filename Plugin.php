<?php

/** @noinspection PhpMissingParentCallCommonInspection */

declare(strict_types=1);

namespace Vdlp\SitemapGenerators;

use Illuminate\Contracts\Events\Dispatcher;
use System\Classes\PluginBase;
use Vdlp\SitemapGenerators\Classes\EventSubscribers\SitemapSubscriber;

/**
 * Class Plugin
 *
 * @package Vdlp\SitemapGenerators
 */
class Plugin extends PluginBase
{
    /**
     * {@inheritDoc}
     */
    public $require = [
        'Vdlp.Sitemap',
    ];

    /**
     * {@inheritDoc}
     */
    public function pluginDetails(): array
    {
        return [
            'name' => 'Sitemap Generators',
            'description' => 'Provides Sitemap Generators for the Vdlp.Sitemap plugin',
            'author' => 'Van der Let & Partners',
            'icon' => 'icon-leaf',
        ];
    }

    /**
     * {@inheritDoc}
     */
    public function register(): void
    {
        /** @var Dispatcher $events */
        $events = $this->app->make(Dispatcher::class);
        $events->subscribe($this->app->make(SitemapSubscriber::class));
    }

    /**
     * {@inheritdoc}
     */
    public function boot(): void
    {
    }
}
