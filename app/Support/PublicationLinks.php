<?php

namespace App\Support;

class PublicationLinks
{
    public static function doi($value): ?string
    {
        $doi = trim((string) $value);
        $doi = preg_replace('~^(?:https?://(?:dx\.)?doi\.org/|doi:\s*)~i', '', $doi);
        if (!preg_match('~^10\.\d{4,9}/\S+$~', $doi)) {
            return null;
        }

        return 'https://doi.org/' . str_replace('%2F', '/', rawurlencode($doi));
    }

    public static function indexing($value): ?string
    {
        $url = trim((string) $value);
        if ($url === '') {
            return null;
        }
        if (strpos($url, '//') === 0) {
            $url = 'https:' . $url;
        } elseif (!preg_match('~^[a-z][a-z0-9+.-]*:~i', $url)) {
            $url = 'https://' . $url;
        }

        return filter_var($url, FILTER_VALIDATE_URL) && in_array(strtolower(parse_url($url, PHP_URL_SCHEME) ?? ''), ['http', 'https'], true)
            ? $url : null;
    }
}
