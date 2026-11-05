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
use App\Support\HomeContent;
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

        $articles = DB::table('article')
            ->join('journals', function ($join) {
                $join->on('article.j_id', '=', 'journals.j_id')
                    ->where('journals.active', 1);
            })
            ->join('issues', function ($join) {
                $join->on('article.i_id', '=', 'issues.id')
                    ->where('issues.active', 1);
            })
            ->where('article.status', 1)
            ->whereNotNull('article.accepted')
            ->whereNotNull('article.published_date')
            ->whereDate('article.accepted', '<=', now()->toDateString())
            ->whereDate('article.published_date', '<=', now()->toDateString())
            ->select('article.*')
            ->orderBy('article.id', 'desc')
            ->limit(6)
            ->get();

        $editors = DB::table('editors_data')
            ->leftJoin('journals', function ($join) {
                $join->on('editors_data.j_id', '=', 'journals.j_id')
                    ->where('journals.active', 1);
            })
            ->where('editors_data.active', 1)
            ->where('editors_data.is_top_editor', 1)
            ->select('editors_data.*', 'journals.j_name', 'journals.slug as journal_slug')
            ->orderBy('editors_data.id', 'desc')
            ->get();
        
        $countJournal = journal::where('active', 1)->count('j_id');
        $countArticle = articles::where('status', 1)->count('id');
        $countDownload = articles::sum('count');

        // return $content;
        return view('home', [
            'contents' => $content, 
            'articles'=>$articles,
            'editors'=>$editors,
            'indexings'=>$indexings,
            'certificates'=>$certificates,
            'countJournal'=>$countJournal,
            'countArticle'=>$countArticle,
            'countDownload'=>$countDownload,
            'homeContent'=>HomeContent::all()
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
            session()->forget('AuthorLoggedUser');
            return redirect()->guest(route('author.login'))->with('message', 'Please login as an author to submit manuscript.');
        }

        $journals = journal::where('active', 1)->orderBy('j_name')->get();
        $top_editors = DB::table('editors_data')
            ->where('is_top_editor', 1)
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('manuscript', [
            'journals' => $journals,
            'author' => $author,
            'top_editors' => $top_editors,
        ]);
    }

    function payments()
    {
        $top_editors = DB::table('editors_data')
            ->where('is_top_editor', 1)
            ->where('active', 1)
            ->orderBy('id', 'desc')
            ->get();

        return view('payments', [
            'paymentConfig' => config('payments'),
            'paypalConfig' => config('services.paypal'),
            'razorpayConfig' => config('services.razorpay'),
            'top_editors' => $top_editors,
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
        return view('archives', [
            'data' => $volumes,
            'journal' => $journal,
            'activeJournalTab' => 'archive',
        ]);
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

        $currentIssueId = DB::table('issues')
            ->join('volume', 'issues.v_id', '=', 'volume.id')
            ->where('volume.j_id', $journal->j_id)
            ->where('issues.active', 1)
            ->select('issues.id as id')
            ->orderBy('volume.year', 'desc')
            ->orderBy('volume.id', 'desc')
            ->orderBy('issues.id', 'desc')
            ->value('id');

        // return $articles;
        return view('articles', [
            'articles' => $articles,
            'volume' => $v,
            'issue' => $i,
            'journal' => $journal,
            'activeJournalTab' => (int) $currentIssueId === (int) $i->id ? 'current' : 'archive',
        ]);
    }


    function allJournals(Request $request){

        // $journals = DB::table('journals')->where('active', 1)->orderBy('j_id', 'desc')->get();
        $journals = journal::where('active', 1)->orderBy('j_name')->get();

        return view('allJournals', ['journals' => $journals]);
    }

    function journal($slug){

        $journal = DB::table('journals')->where('slug', $slug)->where('active', 1)->first();
        abort_unless($journal, 404);
        $recent = DB::table('article')->where('j_id', '=', $journal->j_id)->where('status', 1)->orderBy('id', 'desc')->limit(5)->get();
        $certificates = DB::table('certificates')->where('j_id', $journal->j_id)->where('active', 1)->orderBy('id', 'desc')->get();
        return view('details', [
            'journal' => $journal,
            'articles' => $recent,
            'certificates' => $certificates,
            'activeJournalTab' => 'about',
        ]);
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
        return view('editorial-board', [
            'journal' => $journal,
            'editors' => $editors,
            'activeJournalTab' => 'editorial',
        ]);
    }

}
