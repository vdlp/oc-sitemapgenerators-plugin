<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Generators;

use Carbon\Carbon;
use Cms\Classes\Theme;
use Illuminate\Contracts\Routing\UrlGenerator;
use Psr\Log\LoggerInterface;
use RainLab\Pages\Classes\Page;
use RainLab\Pages\Classes\PageList;
use Throwable;
use Vdlp\Sitemap\Classes\Contracts\DefinitionGenerator;
use Vdlp\Sitemap\Classes\Dto;

final class RainLabPagesGenerator implements DefinitionGenerator
{
    private UrlGenerator $urlGenerator;
    private LoggerInterface $log;

    public function __construct(UrlGenerator $urlGenerator, LoggerInterface $log)
    {
        $this->urlGenerator = $urlGenerator;
        $this->log = $log;
    }

    public function getDefinitions(): Dto\Definitions
    {
        $definitions = new Dto\Definitions();

        if (
            !class_exists('\RainLab\Pages\Classes\Page')
            || !class_exists('\RainLab\Pages\Classes\PageList')
        ) {
            return $definitions;
        }

        $pageList = new PageList(Theme::getActiveTheme());

        /** @var Page $page */
        foreach ($pageList->listPages() as $page) {
            try {
                if ((bool) $page->getViewBag()->property('is_hidden')) {
                    continue;
                }

                $definitions->addItem(
                    (new Dto\Definition())
                        ->setUrl($this->urlGenerator->to($page->getViewBag()->property('url')))
                        ->setPriority(2)
                        ->setChangeFrequency(Dto\Definition::CHANGE_FREQUENCY_DAILY)
                        ->setModifiedAt(Carbon::createFromTimestamp($page->getAttribute('mtime')))
                );
            } catch (Throwable $e) {
                $this->log->error('Vdlp.SitemapGenerators: Unable to add sitemap definition: ' . $e->getMessage());
            }
        }

        return $definitions;
    }
}
