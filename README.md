<p align="center">
	<img height="60px" width="60px" src="https://plugins.vdlp.nl/octobercms/icons/Vdlp.SitemapGenerators.svg">
	<h1 align="center">Vdlp.SitemapGenerators</h1>
</p>

<p align="center">
	<em>This plugin provides Sitemap generators for October CMS.</em>
</p>

<p align="center">
	<img src="https://badgen.net/packagist/php/vdlp/oc-sitemapgenerators-plugin">
	<img src="https://badgen.net/packagist/license/vdlp/oc-sitemapgenerators-plugin">
	<img src="https://badgen.net/packagist/v/vdlp/oc-sitemapgenerators-plugin/latest">
	<img src="https://badgen.net/badge/cms/October%20CMS">
	<img src="https://badgen.net/badge/type/plugin">
	<img src="https://plugins.vdlp.nl/octobercms/badge/installations.php?plugin=vdlp-sitemapgenerators">
</p>

## General

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
