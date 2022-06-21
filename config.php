<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | RainLab.Pages enabled
    |--------------------------------------------------------------------------
    |
    | Enable generators for the RainLab.Pages plugin (default = true).
    |
    */

    'generator_rainlab_pages_enabled' => (bool) env('VDLP_SITEMAP_GENERATORS_RAINLAB_PAGES_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | RainLab.Blog enabled
    |--------------------------------------------------------------------------
    |
    | Enable generators for the RainLab.Blog plugin (default = true).
    |
    */

    'generator_rainlab_blog_enabled' => (bool) env('VDLP_SITEMAP_GENERATORS_RAINLAB_BLOG_ENABLED', true),

    /*
    |--------------------------------------------------------------------------
    | Cms Pages enabled
    |--------------------------------------------------------------------------
    |
    | Enable generates for the CMD Pages (default = true).
    |
    */

    'generator_cms_pages_enabled' => (bool) env('VDLP_SITEMAP_GENERATORS_CMS_PAGES_ENABLED', true),

];
