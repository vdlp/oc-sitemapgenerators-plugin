<?php

declare(strict_types=1);

namespace Vdlp\SitemapGenerators\Classes\Contracts;

use Illuminate\Contracts\Events\Dispatcher;

interface EventSubscriber
{
    public function subscribe(Dispatcher $dispatcher): void;
}
