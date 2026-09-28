<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function robots()
    {
        return response("User-agent: *\nAllow: /\nSitemap: " . url('sitemap.xml') . "\n", 200)
            ->header('Content-Type', 'text/plain; charset=UTF-8');
    }

    public function sitemap()
    {
        return response()->stream(function () {
            echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
            echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
            $write = function ($path) {
                echo '<url><loc>' . htmlspecialchars(url($path), ENT_XML1 | ENT_QUOTES, 'UTF-8') . '</loc></url>';
            };
            foreach (['/', 'journals', 'conference'] as $path) $write($path);
            foreach (DB::table('journals')->where('active', 1)->orderBy('j_id')->cursor() as $journal) {
                foreach (['journal', 'archives', 'editorial-board', 'indexings', 'certificates'] as $prefix) {
                    $write($prefix . '/' . $journal->slug);
                }
            }
            $issues = DB::table('issues')->join('volume', 'volume.id', '=', 'issues.v_id')
                ->join('journals', 'journals.j_id', '=', 'volume.j_id')
                ->where('journals.active', 1)->where('issues.active', 1)
                ->select('journals.slug as journal_slug', 'volume.slug as volume_slug', 'issues.slug as issue_slug')->cursor();
            foreach ($issues as $issue) {
                $write('archives/' . $issue->journal_slug . '/' . $issue->volume_slug . '/' . $issue->issue_slug);
            }
            $articles = DB::table('article')->join('journals', 'journals.j_id', '=', 'article.j_id')
                ->where('article.status', 1)->where('journals.active', 1)->select('article.slug')->distinct()->cursor();
            foreach ($articles as $article) $write('article/' . $article->slug);
            $pages = DB::table('custom_pages')->where('status', 1)->where('type', 'page')->select('path')->distinct()->cursor();
            foreach ($pages as $page) {
                // Only include paths actually served by the public custom-page route.
                $request = \Illuminate\Http\Request::create(url($page->path));
                $route = app('router')->getRoutes()->match($request);
                if ($route->getActionName() === IndexController::class . '@custom_pages') $write($page->path);
            }
            echo '</urlset>';
        }, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
