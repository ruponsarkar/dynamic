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

        $indexings = DB::table('indexing')->where('active', 1)->get();
        $certificates = DB::table('certificates')->where('active', 1)->get();

        $articles = DB::table('article')->where('status', 1)->limit(5)->get();
        
        $countJournal = journal::where('active', 1)->count('j_id');
        $countArticle = articles::where('status', 1)->count('id');
        $countDownload = articles::sum('count');

        // return $content;
        return view('home', [
            'contents' => $content, 
            'articles'=>$articles, 
            'indexings'=>$indexings,
            'certificates'=>$certificates,
            'countJournal'=>$countJournal,
            'countArticle'=>$countArticle,
            'countDownload'=>$countDownload
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

    function payments()
    {
        return view('payments', [
            'paymentConfig' => config('payments'),
            'paypalConfig' => config('services.paypal'),
            'razorpayConfig' => config('services.razorpay'),
        ]);
    }


    function archives($slug)
    {
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $volumes = DB::table('volume')
            ->join('issues', 'issues.v_id', '=', 'volume.id')
            ->select('volume.name as volume_name', 'volume.year', 'volume.slug as volume_slug', 'issues.*')
            ->where('volume.j_id', $journal->j_id)
            ->where('issues.active', 1)
            ->orderBy('volume.year', 'desc')
            ->get()
            ->groupBy('year');


        // return $volumes;
        return view('archives', ['data' => $volumes, 'journal' => $journal]);
    }



    function articles(Request $request, $slug, $v_slug, $i_slug)
    {

        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);

        $v = DB::table('volume')->where('j_id', $journal->j_id)->where('slug', $v_slug)->first();
        abort_unless($v, 404);
        $i = DB::table('issues')->where('v_id', $v->id)->where('slug', $i_slug)->where('active', 1)->first();
        abort_unless($i, 404);


        $articles = DB::table('article')
            ->where('i_id', $i->id)
            ->where('j_id', $journal->j_id)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->get();

        // return $articles;
        return view('articles', ['articles' => $articles, 'volume' => $v, 'issue' => $i, 'journal' => $journal]);
    }


    function allJournals(Request $request){

        // $journals = DB::table('journals')->where('active', 1)->orderBy('j_id', 'desc')->get();
        return view('allJournals');
    }

    function journal($slug){

        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $recent = DB::table('article')->where('j_id', '=', $journal->j_id)->where('status', 1)->orderBy('id', 'desc')->limit(5)->get();
        $certificates = DB::table('certificates')->where('j_id', $journal->j_id)->where('active', 1)->orderBy('id', 'desc')->get();
        return view('details', ['journal' => $journal, 'articles' => $recent, 'certificates' => $certificates]);
    }

    function article($slug){

        $data = DB::table('article')->where('slug', $slug)->where('status', 1)->first();
        abort_unless($data, 404);
        $journal = DB::table('journals')->where('j_id', $data->j_id)->where('active', 1)->first();
        abort_unless($journal, 404);
        $volume = DB::table('volume')->where('id', $data->v_id)->where('j_id', $journal->j_id)->first();
        $issue = DB::table('issues')->where('id', $data->i_id)->where('v_id', $data->v_id)->first();

        return view('article', ['article' => $data, 'journal' => $journal, 'volume' => $volume, 'issue' => $issue]);
    }
    function indexings($slug){
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);

        $data = DB::table('indexing')->where('j_id', $journal->j_id)->where('active', 1)->get();

        // return $data;

        return view('indexings', ['indexings' => $data, 'journal' => $journal]);
    }

    function certificates($slug){
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $data = DB::table('certificates')->where('j_id', $journal->j_id)->where('active', 1)->orderBy('id', 'desc')->get();

        return view('certificates', ['journal' => $journal, 'certificates' => $data]);
    }


    function currentIssue()
    {
        $latest = DB::table('issues')->join('volume', 'volume.id', '=', 'issues.v_id')
            ->join('journals', 'journals.j_id', '=', 'volume.j_id')
            ->where('issues.active', 1)->where('journals.active', 1)
            ->orderBy('issues.id', 'desc')
            ->select('journals.slug as journal_slug', 'volume.slug as volume_slug', 'issues.slug as issue_slug')->first();
        abort_unless($latest, 404);
        return redirect('archives/' . $latest->journal_slug . '/' . $latest->volume_slug . '/' . $latest->issue_slug);
    }


    function editorialBoard($slug)
    {
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $editors = DB::table('editors_data')
        ->where('j_id', $journal->j_id)
        ->where('active', 1)
        ->orderBy('type', 'desc')
        ->get();
        return view('editorial-board', ['journal' => $journal, 'editors' => $editors]);
    }

}
