<?php

namespace App\Support;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * The active journal list (names, slugs and cover filenames) is needed on every page.
 * Admin journal changes clear it; the one-day expiry catches edits made directly in the database.
 */
class CachedJournals
{
    private const CACHE_KEY = 'active_journals';

    public static function all(): Collection
    {
        return Cache::remember(self::CACHE_KEY, now()->addDay(), function () {
            return DB::table('journals')->where('active', 1)->get();
        });
    }

    public static function forget(): void
    {
        Cache::forget(self::CACHE_KEY);
    }
}
