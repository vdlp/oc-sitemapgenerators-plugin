<?php

declare(strict_types=1);

return [
    'generator_rainlab_pages_enabled' => (bool) env('VDLP_SITEMAP_GENERATORS_RAINLAB_PAGES_ENABLED', true),
    'generator_cms_pages_enabled' => (bool) env('VDLP_SITEMAP_GENERATORS_CMS_PAGES_ENABLED', true),
];
