<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Generators;

use Carbon\Carbon;
use Cms\Classes\Theme;
use Illuminate\Contracts\Routing\UrlGenerator;
use RainLab\Pages\Classes\Page;
use RainLab\Pages\Classes\PageList;
use Vdlp\Sitemap\Classes\Contracts\DefinitionGenerator;
use Vdlp\Sitemap\Classes\Dto;

/**
 * Class RainLabPagesGenerator
 *
 * @package Vdlp\SitemapGenerators\Classes\Generators
 */
final class RainLabPagesGenerator implements DefinitionGenerator
{
    /**
     * @var UrlGenerator
     */
    private $urlGenerator;

    /**
     * @param UrlGenerator $urlGenerator
     */
    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * {@inheritDoc}
     */
    public function getDefinitions(): Dto\Definitions
    {
        $definitions = new Dto\Definitions();

        /** @noinspection ClassConstantCanBeUsedInspection */
        if (!class_exists('\RainLab\Pages\Classes\Page')) {
            return $definitions;
        }

        $pageList = new PageList(Theme::getActiveTheme());

        /** @var Page $page */
        foreach ($pageList->listPages() as $page) {
            if ((bool) $page->getViewBag()->property('is_hidden')) {
                continue;
            }

            /** @noinspection PhpUnhandledExceptionInspection */
            $definitions->addItem(
                (new Dto\Definition)
                    ->setUrl($this->urlGenerator->to($page->getViewBag()->property('url')))
                    ->setPriority(2)
                    ->setChangeFrequency(Dto\Definition::CHANGE_FREQUENCY_DAILY)
                    ->setModifiedAt(Carbon::createFromTimestamp($page->getAttribute('mtime')))
            );
        }

        return $definitions;
    }
}
