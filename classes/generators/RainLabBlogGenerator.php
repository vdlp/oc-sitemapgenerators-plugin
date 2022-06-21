<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Generators;

use Cms\Classes\Page;
use Cms\Classes\Theme;
use Illuminate\Contracts\Routing\UrlGenerator;
use Illuminate\Support\Collection;
use RainLab\Blog\Models\Category;
use RainLab\Blog\Models\Post;
use Vdlp\Sitemap\Classes\Contracts\DefinitionGenerator;
use Vdlp\Sitemap\Classes\Dto\Definition;
use Vdlp\Sitemap\Classes\Dto\Definitions;

final class RainLabBlogGenerator implements DefinitionGenerator
{
    /* @var UrlGenerator */
    private $urlGenerator;

    public function __construct(UrlGenerator $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function getDefinitions(): Definitions
    {
        $definitions = new Definitions();

        $theme = Theme::getActiveTheme();

        /** @var Collection|Category[] $categories */
        $categories = Category::all();

        /** @var Collection|Post[] $posts */
        $posts = Post::all();

        /** @var Page $page */
        foreach ($theme->listPages() as $page) {
            // Categories -> blog posts component
            if (isset($page->attributes['blogPosts'])) {
                $url = $page->attributes['url'];
                $pageParam = $this->stripTwigTags($page->attributes['blogPosts']['pageNumber'] ?? null);
                $categoryFilter = $this->stripTwigTags($page->attributes['blogPosts']['categoryFilter'] ?? null);

                if ($categoryFilter === null) {
                    continue;
                }

                foreach ($categories as $category) {
                    $definitionUrl = str_replace($categoryFilter, $category->getAttribute('slug'), $url);

                    if ($pageParam !== null) {
                        $definitionUrl = $this->removeOptionalSlugParam($definitionUrl, $pageParam);
                    }

                    /** @noinspection PhpUnhandledExceptionInspection */
                    $definitions->addItem(
                        (new Definition)
                            ->setUrl($this->urlGenerator->to($definitionUrl))
                            ->setPriority(2)
                            ->setChangeFrequency(Definition::CHANGE_FREQUENCY_MONTHLY)
                            ->setModifiedAt($category->getAttribute('updated_at'))
                    );

                }
            }

            // Posts -> blog post component
            if (isset($page->attributes['blogPost'])) {
                $url = $page->attributes['url'];
                $slugParam = $this->stripTwigTags($page->attributes['blogPost']['slug'] ?? ':slug');

                foreach ($posts as $post) {
                    $definitionUrl = str_replace($slugParam, $post->getAttribute('slug'), $url);

                    /** @noinspection PhpUnhandledExceptionInspection */
                    $definitions->addItem(
                        (new Definition)
                            ->setUrl($this->urlGenerator->to($definitionUrl))
                            ->setPriority(2)
                            ->setChangeFrequency(Definition::CHANGE_FREQUENCY_MONTHLY)
                            ->setModifiedAt($post->getAttribute('updated_at'))
                    );
                }
            }
        }

        return $definitions;
    }

    private function stripTwigTags(?string $var):? string
    {
        if ($var === null) {
            return null;
        }

        $var = str_replace('{{', '', $var);
        $var = str_replace('}}', '', $var);

        return trim($var);
    }

    private function removeOptionalSlugParam(string $url, string $param): string
    {
        $url = str_replace('/' . $param . '?', '', $url);
        $url = str_replace('/' . $param, '', $url);
        return str_replace($param, '', $url);
    }
}
