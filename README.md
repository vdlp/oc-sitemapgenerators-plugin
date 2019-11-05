# VDLP SitemapGenerators plugin

This plugin provides Sitemap generators for October CMS.

Currently the following page types are supported:

- `RainLab.Pages` Page
- October CMS Page

We encourage you to create more Sitemap generators for the common October CMS plugins.
Feel free to create a PR (from `develop` branch) and submit your ideas.

## Requirements

- PHP 7.1 or higher
- This plugin requires the `Vdlp.Sitemap` plugin. 
- October CMS (preferably the latest version).

## Configuration

Add the following lines to the `.env` file of your project:

```
VDLP_SITEMAP_GENERATORS_RAINLAB_PAGES_ENABLED = true
VDLP_SITEMAP_GENERATORS_CMS_PAGES_ENABLED = true
```

To exclude specific URLs from your `sitemap.xml` please refer to the documentation of the `Vdlp.Sitemap` plugin which can be found here: https://github.com/vdlp/oc-sitemap-plugin/blob/master/README.md

## Issues

If you have issues using this plugin. Please create an issue on GitHub or contact us at [octobercms@vdlp.nl]().

## Contribution

Any help is appreciated. Or feel free to create a Pull Request on GitHub.
