<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\HomeArticle;
use App\Models\articles;
use App\Models\journal;
use App\Models\visitor;
use App\Models\indexings;
use App\Models\home_asset;
use App\Models\manuscripts;
use App\Models\manuscript_status;
use DB;


class IndexController extends Controller
{
    //
    public function index()
    {

        $content = DB::table('custom_pages')
        ->where('type', 'content')
        ->where('path', 'like', 'home.%')
        ->where('status', 1)
        ->get();

        // return $content;
        return view('home', ['contents' => $content]);
    }

    public function custom_pages($path)
    {
        $data = DB::table('custom_pages')
            ->where('path', $path)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();

        if ($data == null) {
            abort(404, 'Data not found');
        }

        return view('custom_page', ['data' => $data]);
    }


    function manuscript()
    {
        $journals = journal::get();
        return view('manuscript', ['journals' => $journals]);
    }


    function archives()
    {

        $volumes = DB::table('volume')
            ->join('issues', 'issues.v_id', '=', 'volume.id')
            ->select('volume.name as volume_name', 'volume.year', 'volume.slug as volume_slug', 'issues.*')
            ->orderBy('volume.year', 'desc')
            ->get()
            ->groupBy('year');


        // return $volumes;
        return view('archives', ['data' => $volumes]);
    }



    function articles($v_slug, $i_slug)
    {
        $v = DB::table('volume')->where('slug', $v_slug)->first();
        $i = DB::table('issues')->where('slug', $i_slug)->first();

        $articles = DB::table('article')
            ->where('i_id', $i->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // return $articles;
        return view('articles', ['articles' => $articles, 'volume' => $v, 'issue' => $i]);
    }


    function journal($slug){

        $article = DB::table('article')->where('slug', $slug)->first();

        if (!$article) {
            abort(404, 'Article not found');
        }

        $volume = null;
        $issue = null;

        if (!empty($article->v_id)) {
            $volume = DB::table('volume')->where('id', $article->v_id)->first();
        }

        if (!empty($article->i_id)) {
            $issue = DB::table('issues')->where('id', $article->i_id)->first();
        }
        // return $volume;

        return view('journal', [
            'article' => $article,
            'volume' => $volume,
            'issue' => $issue,
        ]);
    }


    function currentIssue()
    {
        $v = DB::table('volume')->orderBy('id', 'desc')->first();
        $i = DB::table('issues')->orderBy('id', 'desc')->first();
        
        if (!$v || !$i) {
            abort(404, 'Volume or Issue not found');
        }


        $articles = DB::table('article')
            ->where('i_id', $i->id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // return $articles;
        return view('articles', ['articles' => $articles, 'volume' => $v, 'issue' => $i]);
    }

    public function sitemap()
    {
        $urls = [];

        $staticPages = [
            ['path' => '/', 'changefreq' => 'daily', 'priority' => '1.0'],
            ['path' => '/manuscript', 'changefreq' => 'monthly', 'priority' => '0.7'],
            ['path' => '/archives', 'changefreq' => 'weekly', 'priority' => '0.9'],
            ['path' => '/current-issue', 'changefreq' => 'daily', 'priority' => '0.9'],
            ['path' => '/conference', 'changefreq' => 'weekly', 'priority' => '0.6'],
        ];

        foreach ($staticPages as $page) {
            $urls[] = [
                'loc' => url($page['path']),
                'lastmod' => now()->toAtomString(),
                'changefreq' => $page['changefreq'],
                'priority' => $page['priority'],
            ];
        }

        $issues = DB::table('issues')
            ->join('volume', 'volume.id', '=', 'issues.v_id')
            ->select(
                'issues.slug as issue_slug',
                'volume.slug as volume_slug'
            )
            ->orderBy('volume.year', 'desc')
            ->orderBy('issues.id', 'desc')
            ->get();

        foreach ($issues as $issue) {
            $urls[] = [
                'loc' => url('archives/' . $issue->volume_slug . '/' . $issue->issue_slug),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'weekly',
                'priority' => '0.8',
            ];
        }

        $articles = DB::table('article')
            ->where('status', 1)
            ->select('slug', 'published_date')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($articles as $article) {
            if (empty($article->slug)) {
                continue;
            }

            $urls[] = [
                'loc' => url('journal/' . $article->slug),
                'lastmod' => $this->resolveLastmod([$article->published_date]),
                'changefreq' => 'monthly',
                'priority' => '0.7',
            ];
        }

        $customPages = DB::table('custom_pages')
            ->where('status', 1)
            ->where('type', 'page')
            ->whereNotNull('path')
            ->where('path', 'not like', 'home.%')
            ->select('path')
            ->orderBy('id', 'desc')
            ->get();

        foreach ($customPages as $page) {
            if (empty($page->path)) {
                continue;
            }

            $urls[] = [
                'loc' => url($page->path),
                'lastmod' => now()->toAtomString(),
                'changefreq' => 'monthly',
                'priority' => '0.6',
            ];
        }

        $urls = collect($urls)
            ->unique('loc')
            ->values()
            ->all();

        return response()
            ->view('sitemap', ['urls' => $urls])
            ->header('Content-Type', 'application/xml; charset=UTF-8');
    }

    private function resolveLastmod(array $candidates)
    {
        foreach ($candidates as $candidate) {
            if (empty($candidate)) {
                continue;
            }

            try {
                return Carbon::parse($candidate)->toAtomString();
            } catch (\Throwable $e) {
                continue;
            }
        }

        return now()->toAtomString();
    }

}
