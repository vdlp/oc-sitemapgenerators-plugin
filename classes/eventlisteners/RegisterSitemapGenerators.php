<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\EventListeners;

use Vdlp\SitemapGenerators\Classes\Generators\CmsPagesGenerator;
use Vdlp\SitemapGenerators\Classes\Generators\RainLabPagesGenerator;

final class RegisterSitemapGenerators
{
    public function handle(): array
    {
        $generators = [];

        if ((bool) config('sitemapgenerators.generator_rainlab_pages_enabled', true)) {
            $generators[] = resolve(RainLabPagesGenerator::class);
        }

        if ((bool) config('sitemapgenerators.generator_cms_pages_enabled', true)) {
            $generators[] = resolve(CmsPagesGenerator::class);
        }

        return $generators;
    }
}
