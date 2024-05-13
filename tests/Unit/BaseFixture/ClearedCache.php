<?php
namespace Tests\Unit\BaseFixture;

use Illuminate\Contracts\Cache;
use Tests\Unit\BaseFixture\Server\Laravel;

trait ClearedCache
{
    use Laravel\Application;

    /**
     * @before
     */
    function clearCache(): void
    {
        $laravel = Laravel\StaticLaravel::get($this);
        $cache = $laravel->app[Cache\Repository::class];
        $cache->clear();
    }
}
