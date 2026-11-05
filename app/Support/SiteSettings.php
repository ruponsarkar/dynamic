<?php

namespace App\Support;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Admin-editable key/value settings, cached until they next change.
 * Secrets are stored encrypted, so the cache only ever holds ciphertext.
 */
class SiteSettings
{
    private const CACHE_KEY = 'site_settings';

    private static $loaded = null;

    public static function all(): array
    {
        if (self::$loaded !== null) {
            return self::$loaded;
        }

        try {
            return self::$loaded = Cache::rememberForever(self::CACHE_KEY, function () {
                return DB::table('site_settings')->pluck('value', 'key')->all();
            });
        } catch (QueryException $e) {
            // Table not migrated yet: fall back to defaults rather than take the site down.
            return self::$loaded = [];
        }
    }

    public static function get(string $key, $default = null)
    {
        $value = self::all()[$key] ?? null;

        return $value === null || $value === '' ? $default : $value;
    }

    public static function secret(string $key, $default = null)
    {
        $value = self::get($key);

        if ($value === null) {
            return $default;
        }

        try {
            return Crypt::decryptString($value);
        } catch (DecryptException $e) {
            Log::warning("Could not decrypt setting {$key}; was APP_KEY changed?");

            return $default;
        }
    }

    public static function putMany(array $values): void
    {
        DB::transaction(function () use ($values) {
            foreach ($values as $key => $value) {
                $exists = DB::table('site_settings')->where('key', $key)->exists();
                $row = ['value' => $value, 'updated_at' => now()];

                if ($exists) {
                    DB::table('site_settings')->where('key', $key)->update($row);
                } else {
                    DB::table('site_settings')->insert($row + ['key' => $key, 'created_at' => now()]);
                }
            }
        });

        Cache::forget(self::CACHE_KEY);
        self::$loaded = null;
    }

    public static function putSecret(string $key, string $value): void
    {
        self::putMany([$key => Crypt::encryptString($value)]);
    }
}
