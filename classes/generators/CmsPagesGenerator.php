<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Generators;

use Carbon\Carbon;
use Cms\Classes\CmsObjectCollection;
use Cms\Classes\Page;
use Cms\Classes\Theme;
use Psr\Log\LoggerInterface;
use Throwable;
use Vdlp\Sitemap\Classes\Contracts\DefinitionGenerator;
use Vdlp\Sitemap\Classes\Dto;

final class CmsPagesGenerator implements DefinitionGenerator
{
    private LoggerInterface $log;

    public function __construct(LoggerInterface $log)
    {
        $this->log = $log;
    }

    public function getDefinitions(): Dto\Definitions
    {
        $definitions = new Dto\Definitions();

        try {
            /** @var CmsObjectCollection $pageList */
            $pageList = Theme::getActiveTheme()->listPages();
        } catch (Throwable $e) {
            $this->log->error('Vdlp.SitemapGenerators: Unable to list theme pages: ' . $e->getMessage());

            return $definitions;
        }

        /** @var Page $page */
        foreach ($pageList as $page) {
            if ((bool) $page->getAttribute('is_hidden')) {
                continue;
            }

            try {
                /** @var ?string $url */
                $url = Page::url($page->getId());
            } catch (Throwable $e) {
                $this->log->error('Vdlp.SitemapGenerators: Unable to create page URL: ' . $e->getMessage());

                continue;
            }

            if ($url !== null && $url !== '') {
                /** @noinspection PhpUnhandledExceptionInspection */
                $definitions->addItem(
                    (new Dto\Definition())
                        ->setUrl($url)
                        ->setPriority(2)
                        ->setChangeFrequency(Dto\Definition::CHANGE_FREQUENCY_DAILY)
                        ->setModifiedAt(Carbon::createFromTimestamp($page->getAttribute('mtime')))
                );
            }
        }

        return $definitions;
    }
}
