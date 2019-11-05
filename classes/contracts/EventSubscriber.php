<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Contracts;

use Illuminate\Contracts\Events\Dispatcher;

/**
 * Interface EventSubscriber
 *
 * @package Vdlp\SitemapGenerators\Classes\Contracts
 */
interface EventSubscriber
{
    /**
     * @param Dispatcher $dispatcher
     * @return void
     */
    public function subscribe(Dispatcher $dispatcher): void;
}
