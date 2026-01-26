<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('journal', ['article' => $article]);
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

}
