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
use App\Models\Author;
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

        $articles = DB::table('article')->where('status', 1)->limit(6)->get();
        
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

    public function search(Request $request)
    {
        $searchTerm = trim($request->query('q', ''));

        $query = DB::table('article')
            ->where('status', 1)
            ->when($searchTerm !== '', function ($query) use ($searchTerm) {
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'like', '%' . $searchTerm . '%')
                        ->orWhere('aname', 'like', '%' . $searchTerm . '%')
                        ->orWhere('doi', 'like', '%' . $searchTerm . '%')
                        ->orWhere('keywords', 'like', '%' . $searchTerm . '%')
                        ->orWhere('abstract', 'like', '%' . $searchTerm . '%');
                });
            })
            ->orderBy('id', 'desc');

        if ($request->expectsJson() || $request->is('api/*')) {
            return response()->json([
                'query' => $searchTerm,
                'articles' => $searchTerm === '' ? [] : $query->limit(10)->get(),
            ]);
        }

        $articles = $searchTerm === ''
            ? collect()
            : $query->paginate(10)->withQueryString();

        return view('search', [
            'articles' => $articles,
            'query' => $searchTerm,
        ]);
    }


    function manuscript()
    {
        $author = Author::find(session('AuthorLoggedUser'));

        if (!$author) {
            return redirect()->route('author.login')->with('message', 'Please login as an author to submit manuscript.');
        }

        $journals = journal::get();
        return view('manuscript', ['journals' => $journals, 'author' => $author]);
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

        $v = DB::table('volume')->where('j_id', $journal->j_id)->where('slug', $v_slug)
            ->when($request->query('v'), function ($query, $id) { $query->where('id', $id); })->first();
        abort_unless($v, 404);
        $i = DB::table('issues')->where('v_id', $v->id)->where('slug', $i_slug)->where('active', 1)
            ->when($request->query('i'), function ($query, $id) { $query->where('id', $id); })->first();
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

        $data = articles::with('publicationAuthors')->where('slug', $slug)->where('status', 1)->firstOrFail();
        $journal = DB::table('journals')->where('j_id', $data->j_id)->where('active', 1)->first();
        abort_unless($journal, 404);
        $volume = DB::table('volume')->where('id', $data->v_id)->where('j_id', $journal->j_id)->first();
        $issue = DB::table('issues')->where('id', $data->i_id)->where('v_id', $data->v_id)->first();
        return view('article', ['article' => $data, 'journal' => $journal, 'volume' => $volume, 'issue' => $issue]);
    }
    function indexings($slug){
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);

        $data = DB::table('indexing')->where('j_id', $journal->j_id)->get();

        // return $data;

        return view('indexings', ['indexings' => $data, 'journal' => $journal]);
    }

    function certificates($slug){
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $data = DB::table('certificates')->where('j_id', $journal->j_id)->where('active', 1)->orderBy('id', 'desc')->get();

        return view('certificates', ['journal' => $journal, 'certificates' => $data]);
    }


    function currentIssue($slug)
    {
        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);

        if (!$journal) {
            abort(404, 'Journal not found');
        }

        $latestIssue = DB::table('issues')
            ->join('volume', 'issues.v_id', '=', 'volume.id')
            ->select('issues.id', 'issues.slug', 'volume.id as volume_id', 'volume.slug as volume_slug')
            ->where('volume.j_id', $journal->j_id)
            ->where('issues.active', 1)
            ->orderBy('volume.year', 'desc')
            ->orderBy('volume.id', 'desc')
            ->orderBy('issues.id', 'desc')
            ->first();

        if (!$latestIssue) {
            return redirect(url('archives/' . $journal->slug));
        }

        return redirect(url('archives/' . $journal->slug . '/' . $latestIssue->volume_slug . '/' . $latestIssue->slug . '?i=' . $latestIssue->id . '&v=' . $latestIssue->volume_id));
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
