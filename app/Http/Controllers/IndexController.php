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

        $homeIndexings = DB::table('indexing')
            ->where('active', 1)
            ->where('isShowOnHome', 1)
            ->orderBy('id', 'desc')
            ->get();

        // return $content;
        return view('home', [
            'contents' => $content,
            'indexings' => $homeIndexings,
        ]);
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


    function archives($slug)
    {
        $journal = DB::table('journals')->where('slug', $slug)->first();
        $volumes = DB::table('volume')
            ->join('issues', 'issues.v_id', '=', 'volume.id')
            ->select('volume.name as volume_name', 'volume.year', 'volume.slug as volume_slug', 'issues.*')
            ->where('volume.j_id', $journal->j_id)
            ->orderBy('volume.year', 'desc')
            ->get()
            ->groupBy('year');


        // return $volumes;
        return view('archives', ['data' => $volumes, 'journal' => $journal]);
    }



    function articles(Request $request, $slug, $v_slug, $i_slug)
    {

        $i_id = $request->query('i');
        $v_id = $request->query('v');
        $journal = DB::table('journals')->where('slug', $slug)->first();

        $v = DB::table('volume')->where('j_id', $journal->j_id)->where('id', $v_id)->first();
        $i = DB::table('issues')->where('id', $i_id)->first();


        $articles = DB::table('article')
            ->where('i_id', $i->id)
            ->where('j_id', $journal->j_id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // return $articles;
        return view('articles', ['articles' => $articles, 'volume' => $v, 'issue' => $i]);
    }


    function allJournals(Request $request){

        // $journals = DB::table('journals')->where('active', 1)->orderBy('j_id', 'desc')->get();
        return view('allJournals');
    }

    function journal($slug){

        $journal = DB::table('journals')->where('slug', $slug)->first();
        $recent = DB::table('article')->where('j_id', '=', $journal->j_id)->where('status', 1)->orderBy('id', 'desc')->limit(5)->get();
        $indexings = DB::table('indexing')
            ->where('j_id', $journal->j_id)
            ->where('active', 1)
            ->get();
        return view('details', ['journal' => $journal, 'articles' => $recent, 'indexings' => $indexings]);
    }

    function article($slug){

        $data = DB::table('article')->where('slug', $slug)->first();

        return view('article', ['article' => $data]);
    }
    function indexings($slug){
        $journal = DB::table('journals')->where('slug', $slug)->first();

        $data = DB::table('indexing')
            ->where('j_id', $journal->j_id)
            ->where('active', 1)
            ->get();

        // return $data;

        return view('indexings', ['indexings' => $data, 'journal' => $journal]);
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


    function editorialBoard($slug)
    {
        $journal = DB::table('journals')->where('slug', $slug)->first();
        $editors = DB::table('editors_data')
        ->where('j_id', $journal->j_id)
        ->where('active', 1)
        ->orderBy('type', 'desc')
        ->get();
        return view('editorial-board', ['journal' => $journal, 'editors' => $editors]);
    }

}
