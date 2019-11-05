<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\EventListeners;

use Vdlp\SitemapGenerators\Classes\Generators\CmsPagesGenerator;
use Vdlp\SitemapGenerators\Classes\Generators\RainLabPagesGenerator;

/**
 * Class RegisterSitemapGenerators
 *
 * @package Vdlp\SitemapGenerators\Classes\EventListeners
 */
final class RegisterSitemapGenerators
{
    /**
     * @return array
     */
    public function handle(): array
    {
        $generators = [];

        if (config('vdlp.sitemapgenerators::generator_rainlab_pages_enabled')) {
            $generators[] = resolve(RainLabPagesGenerator::class);
        }

        if (config('vdlp.sitemapgenerators::generator_cms_pages_enabled')) {
            $generators[] = resolve(CmsPagesGenerator::class);
        }

        return $generators;
    }
}
