<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    private const PAGE_SIZE = 1000;

    public function robots()
    {
        return response("User-agent: *\nAllow: /\nSitemap: " . url('sitemap.xml') . "\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    private function query(string $section)
    {
        switch ($section) {
            case 'journals':
                return DB::table('journals')->where('active', 1)->select('slug')->distinct()->orderBy('slug');
            case 'articles':
                return DB::table('article')->join('journals', 'journals.j_id', '=', 'article.j_id')
                    ->where('article.status', 1)->where('journals.active', 1)->select('article.slug')->distinct()->orderBy('article.slug');
            case 'issues':
                return DB::table('issues')->join('volume', 'volume.id', '=', 'issues.v_id')
                    ->join('journals', 'journals.j_id', '=', 'volume.j_id')
                    ->where('journals.active', 1)->where('issues.active', 1)
                    ->select('journals.slug as journal_slug', 'volume.slug as volume_slug', 'issues.slug as issue_slug', 'issues.id as issue_id', 'volume.id as volume_id')->distinct()
                    ->orderBy('issues.id');
            case 'pages':
                return DB::table('custom_pages')->where('status', 1)->where('type', 'page')->select('path')->distinct()->orderBy('path');
        }
        abort(404);
    }

    public function sitemap()
    {
        $locations = [url('sitemaps/general/1.xml')];
        foreach (['journals', 'articles', 'issues', 'pages'] as $section) {
            $count = DB::query()->fromSub($this->query($section), 'entries')->count();
            for ($page = 1; $page <= (int) ceil($count / self::PAGE_SIZE); $page++) {
                $locations[] = url('sitemaps/' . $section . '/' . $page . '.xml');
            }
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?><sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($locations as $location) $xml .= '<sitemap><loc>' . $this->escape($location) . '</loc></sitemap>';
        return response($xml . '</sitemapindex>', 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    public function section(string $section, int $page)
    {
        abort_unless($page >= 1 && $page <= 1000000, 404);
        $paths = [];
        if ($section === 'general') {
            abort_unless($page === 1, 404);
            $paths = ['/', 'journals', 'conference'];
        } else {
            $entries = $this->query($section)->offset(($page - 1) * self::PAGE_SIZE)->limit(self::PAGE_SIZE)->get();
            abort_if($entries->isEmpty(), 404);
            foreach ($entries as $entry) {
                if ($section === 'journals') {
                    foreach (['journal', 'archives', 'editorial-board', 'indexings', 'certificates'] as $prefix) $paths[] = $prefix . '/' . $entry->slug;
                } elseif ($section === 'articles') {
                    $paths[] = 'article/' . $entry->slug;
                } elseif ($section === 'issues') {
                    $paths[] = 'archives/' . $entry->journal_slug . '/' . $entry->volume_slug . '/' . $entry->issue_slug . '?i=' . $entry->issue_id . '&v=' . $entry->volume_id;
                } else {
                    if (!preg_match('~^[^/?:#]+$~', $entry->path)) continue;
                    $route = app('router')->getRoutes()->match(\Illuminate\Http\Request::create(url($entry->path)));
                    if ($route->getActionName() === IndexController::class . '@custom_pages') $paths[] = $entry->path;
                }
            }
        }
        $xml = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        foreach ($paths as $path) $xml .= '<url><loc>' . $this->escape(url($path)) . '</loc></url>';
        return response($xml . '</urlset>', 200)->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function escape(string $value): string
    {
        return htmlspecialchars($value, ENT_XML1 | ENT_QUOTES, 'UTF-8');
    }
}
