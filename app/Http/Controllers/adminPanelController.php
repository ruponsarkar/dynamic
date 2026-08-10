<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\manuscripts;
use App\Models\journal;
use App\Models\indexings;
use App\Models\admins;
use App\Models\reviewer;
use App\Models\editor_data;
use App\Models\volumes;
use App\Models\issue;
use App\Models\articles;
use App\Models\book;
use App\Models\editor;
use App\Models\home_asset;
use App\Models\manuscript_status;
use App\Models\conference;
use Carbon;
use Illuminate\Support\Facades\Hash;
use DB;
use Illuminate\Support\Str;

class adminPanelController extends Controller
{
    //
    function login()
    {
        return view('adminpanel.login');
    }

    function adminIndex()
    {
        $HomeAssets = home_asset::where('active', 1)->first();
        $countJournal = journal::count('j_id');
        $countArticle = articles::where('status', 1)->count('id');
        $countDownload = articles::sum('count');
        return view('adminpanel.index', ['HomeAssets' => $HomeAssets, 'countJournal' => $countJournal, 'countArticle' => $countArticle, 'countDownload' => $countDownload]);
    }

    function allManuscript()
    {

        $manuscript = manuscripts::orderBy('m_id', 'DESC')->get();

        return view('adminpanel.all-manuscript', ['manuscript' => $manuscript]);
    }

    // status change of manuscript
    function updateManuscript(Request $request)
    {

        // return $request->selectedID;
        // $getRowValue = manuscripts::where('m_id', $request->selectedID)->first();

        // here selectedID is muuid
        $exists = manuscript_status::where('muuid', $request->selectedID)->exists();

        // if ($exists) {
        // $manuscriptStatus = new manuscript_status;
        // $manuscriptStatus->muuid = $request->selectedID;
        // $manuscriptStatus->status = $request->selectedStatus;
        // $manuscriptStatus->date = date('d-m-Y', strtotime(Carbon\Carbon::now()));

        // $manuscriptStatus->update();
        //     $updateISExist = manuscript_status::where('muuid', $request->selectedID)->update([
        //         'muuid' => $request->selectedID,
        //         'status' => $request->selectedStatus,
        //         'date' => date('d-m-Y', strtotime(Carbon\Carbon::now()))
        //     ]);
        // } else {
        $manuscriptStatus = new manuscript_status;
        $manuscriptStatus->muuid = $request->selectedID;
        $manuscriptStatus->status = $request->selectedStatus;
        $manuscriptStatus->date = date('d-m-Y', strtotime(Carbon\Carbon::now()));

        $manuscriptStatus->save();
        // }
        // return response()->json(['success' => $getRowValue]);;
        // $updateManuStatus = manuscript_status::insert($request->selectedID,$getRowValue);

        // return $updateManuStatus;

        $updaetValue = manuscripts::where('m_id', $request->selectedRowID)->update([
            'status' => $request->selectedStatus
        ]);
        // $insertStatus = manuscript_status::where()

        return response()->json(['success' => $updaetValue]);
        // return response()->json(['success' => 'done']);
    }

    function allEditorsRequest()
    {

        $editors = editor::orderBy('e_id', 'DESC')->get();

        return view('adminpanel.all-editors-request', ['editors' => $editors]);
    }

    function allReviewerRequest()
    {
        $reviewer = reviewer::orderBy('r_id', 'DESC')->get();
        return view('adminpanel.all-reviewer-request', ['reviewer' => $reviewer]);
    }

    function journalForm()
    {

        $journal = journal::get()->where('active', 1);

        return view('adminpanel.add-journal', ['journal' => $journal]);
    }

    function addJournal(Request $request)
    {
        $request->validate([
            'jname' => 'required|max:1000',
            'abbr' => 'max:1000',
            'issn' => 'max:1000',
            'frequency' => 'max:1000',
            'language' => 'max:1000',
            'chief' => 'max:1000',
            'publisher' => 'max:1000',
            'country' => 'max:1000',
            // 'aim' => 'max:10000',
            'photo' => 'required|mimes:jpeg,jpg,png',


        ]);

        $journalName = strip_tags($request->jname);
        $slug = Str::slug($journalName);

        $check = journal::where('slug', $slug)->count();
        if ($check > 0) {
            $slug = $slug . '-' . $check;
        }

        $photo = time() . '.' . $request->photo->extension();

        $journal = new journal;
        $journal->j_name = strip_tags($request->jname);
        $journal->slug = $slug;
        $journal->abbr_title = strip_tags($request->abbr);
        $journal->issn = strip_tags($request->issn);
        $journal->frequency = strip_tags($request->frequency);
        $journal->language = strip_tags($request->language);
        $journal->chief_editor = strip_tags($request->chief);
        $journal->publisher = strip_tags($request->publisher);
        $journal->country_of_origin = strip_tags($request->country);
        $journal->aim_and_scope = strip_tags($request->aim);
        $journal->subject = strip_tags($request->subject);
        $journal->format = strip_tags($request->formatOfJournal);
        $journal->starting_year = strip_tags($request->starting_year);
        $journal->photo = strip_tags($photo);

        $journal->ip_address = \Request::ip();

        $journal->save();


        $request->photo->move(base_path('public/assets/journals/img'), $photo);


        return redirect('journalForm')->with('message', 'Your request Submitted successfully');
    }
    function conference()
    {
        $confrence = conference::orderBy('id', 'DESC')->where('isActive', 1)->get();

        return view('conference', ['confrence' => $confrence]);
    }

    function addConferenceinsert(Request $request)
    {
        $request->validate([
            'title' => 'required|max:1000',
            'file' => 'required|mimes:pdf,docx',
        ]);

        $namewithextension = $request->file->getClientOriginalName();

        $fileOriginalName = explode('.', $namewithextension)[0];

        $file = time() . '.' . $request->file->extension();

        $save = conference::insert([
            'title' => $request->title,
            'file' => $file
        ]);
        $request->file->move(base_path('public/assets/conference'), $file);
        return redirect('add-conference')->with('message', 'Your request Submitted successfully');
    }
    function updateconference(Request $request, $id)
    {
        $conference = conference::find($id);
        return view('adminpanel.update-conference', ['conference' => $conference]);
    }
    function updateconferenceData(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:200',
            'file' => 'required|mimes:pdf,docx',

        ]);
        $namewithextension = $request->file->getClientOriginalName();

        $fileOriginalName = explode('.', $namewithextension)[0];

        $file = time() . '.' . $request->file->extension();

        $conference = conference::find($id);
        $conference->title = strip_tags($request->title);
        $conference->file = $file;
        $conference->update();
        return redirect('add-conference')->with('message', 'Your request Submitted successfully');

    }
    function deleteconference(Request $request, $id)
    {
        $journal = conference::where('id', $id)->update([
            'isActive' => 0
        ]);
        return redirect()->back()->with('message', 'Deleted');
    }

    function addconference()
    {
        $confrence = conference::orderBy('id', 'DESC')->where('isActive', 1)->get();
        return view('adminpanel.add-conference', ['confrence' => $confrence]);
    }
    function deleteJournals(Request $request, $id)
    {
        $journal = journal::where('j_id', $id)->update([
            'active' => 0
        ]);
        return redirect()->back()->with('message', 'Deleted');
    }

    function addIndexingPage()
    {
        $journals = journal::get();
        $indexing = indexings::join("journals", "journals.j_id", "=", "indexing.j_id")->get();
        return view('adminpanel.SelectIndexing', ['journals' => $journals, 'indexing' => $indexing]);
    }

    function addIndexing(Request $request)
    {
        // return $request->all();

        // $request->validate([
        //     'journal' => 'required|max:100',
        //     'link' => 'max:1000',
        //     'photo' => 'required|mimes:jpeg,jpg,png',
        // ]);

        // if($request->file('photo')){
        //     return  $request->photo->getClientOriginalName();;
        // }
        // else{
        //     return "no";
        // }



        $photo = time() . '.' . $request->photo->getClientOriginalName();
        // return $photo;
        $indexing = new indexings;
        $indexing->j_id = strip_tags($request->journal);
        $indexing->link = strip_tags($request->link);
        $indexing->img = strip_tags($photo);
        $indexing->isShowOnHome = $request->has('isShowOnHome') ? 1 : 0;
        $indexing->ip_address = \Request::ip();

        $indexing->save();

        $request->photo->move(base_path('public/assets/indexing/img'), $photo);

        return back()->with('message', 'Your request Submitted successfully');
    }

    function regis()
    {
        return view('adminpanel.register');
    }

    function addAdmin(Request $request)
    {
        $admin = new admins;
        $admin->username = $request->user;
        $admin->email = $request->email;
        $admin->pass = Hash::make($request->pass);

        $save = $admin->save();

        if ($save) {
            // return back()->with('message', 'Success');
            return redirect('login')->with('message', 'Success');
        } else {
            return back()->with('message', 'error');
        }
    }

    function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'pass' => 'required|max:300',

        ]);
        $userInfo = admins::where('email', '=', $request->email)->first();

        if (!$userInfo) {
            return back()->with('message', 'Wrong email');
        } else {
            if (Hash::check($request->pass, $userInfo->pass)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect('admin_index');
            } else {
                return back()->with('message', 'Wrong password');
            }
        }
    }

    function logout()
    {
        if (session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect('login');
        }
    }


    function viewer(Request $request, $id)
    {

        $manuscript = manuscripts::get()->where('m_id', $id);
        return view('adminpanel.viewer', ['manuscript' => $manuscript]);
    }

    function addEditors()
    {
        $journal = journal::get();
        $editors = editor_data::orderby('id', 'desc')->where('active', '1')->get();

        return view('adminpanel.add-editors', ['journal' => $journal, 'editors' => $editors]);
    }

    function editors(Request $request)
    {

        $request->validate([
            'name' => 'required|max:200',
            'university' => 'max:3000',
            'details' => 'max:3000',
            'type' => 'required|max:100',
            'journal' => 'required|max:500',
            'profile' => 'max:2000',
            'photo' => 'required|mimes:jpeg,jpg,png',

        ]);


        $photo = time() . '.' . $request->photo->extension();
        // $photo = 'null';

        $editor = new editor_data;
        $editor->name = strip_tags($request->name);
        $editor->designation = strip_tags($request->designation);
        $editor->university = strip_tags($request->university);
        $editor->details = strip_tags($request->details);
        $editor->type = strip_tags($request->type);
        $editor->is_top_editor = strip_tags($request->is_top_editor);
        $editor->j_id = strip_tags($request->journal);
        $editor->profile = strip_tags($request->profile);
        $editor->image = strip_tags($photo);

        $editor->ip_address = \Request::ip();

        $editor->save();
        $request->photo->move(base_path('public/assets/img/editor-img'), $photo);






        return redirect('addEditors')->with('message', 'Your request Submitted successfully');
    }

    function edit_editor(Request $request, $id)
    {

        $editors = editor_data::find($id);
        $journal = journal::get();

        return view('adminpanel.edit_editors', ['editors' => $editors, 'journal' => $journal]);
    }


    function updateEditors(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:200',
            'university' => 'max:3000',
            'details' => 'max:3000',
            'type' => 'required|max:100',
            'journal' => 'required|max:500',
            'profile' => 'max:2000',
            // 'photo'=>'required|mimes:jpeg,jpg,png',

        ]);


        if($request->file('photo')){
               $photo = time().'.'.$request->photo->extension();
        }

        $editor = editor_data::find($id);
        $editor->name = strip_tags($request->name);
        $editor->designation = strip_tags($request->designation);
        $editor->university = strip_tags($request->university);
        $editor->details = strip_tags($request->details);
        $editor->type = strip_tags($request->type);
        $editor->is_top_editor = strip_tags($request->is_top_editor);
        $editor->j_id = strip_tags($request->journal);
        $editor->profile = strip_tags($request->profile);

        if($request->file('photo')){
           $editor->image=strip_tags($photo);
        }

        $editor->ip_address = \Request::ip();

        $editor->update();
        if($request->file('photo')){
           $request->photo->move(base_path('public/assets/img/editor-img'), $photo);
        }

        return redirect('addEditors')->with('message', 'Your request Submitted successfully');
    }


    function delete_editors(Request $request, $id)
    {

        $editor_data = editor_data::find($id);
        $editor_data->active = 0;
        $editor_data->update();

        return redirect()->back()->with('message', 'Deleted');
    }

    function addVolume()
    {
        $journal = journal::get();

        $volume = volumes::join("journals", "journals.j_id", "=", "volume.j_id")->orderby('id', 'desc')->get();


        return view('adminpanel.add-volume', ['journal' => $journal, 'volume' => $volume]);
    }


    function addVolumeData(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'journal' => 'required|max:50',
        ]);

        $string = str_replace(' ', '-', $request->name);  //replace space
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); //remove special char


        $volumes = new volumes;
        $volumes->name = strip_tags($request->name);
        $volumes->year = strip_tags($request->year);

        $volumes->slug = strip_tags($slug);

        $volumes->j_id = strip_tags($request->journal);


        $volumes->ip_address = \Request::ip();

        $volumes->save();


        return redirect('add-volume')->with('message', 'Added');
    }

    function updateVolume(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:volume,id',
            'name' => 'required|string|max:255',
            'year' => 'nullable|max:50',
        ]);

        $string = str_replace(' ', '-', $request->name);
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string);

        $volume = volumes::find($request->id);
        $volume->name = strip_tags($request->name);
        $volume->year = strip_tags($request->year);
        $volume->slug = strip_tags($slug);
        $volume->save();

        return redirect('add-volume')->with('message', 'Volume updated successfully');
    }

    function addIssues(Request $request, $id)
    {

        $issues = issue::get()->where('active', 1)->where('v_id', $id);

        return view('adminpanel.add-issues', ['id' => $id, 'issues' => $issues]);
    }
    function updateIssues(Request $request)
    {
        // return $request->all();
        // Validate the request data
        $request->validate([
            'id' => 'required|exists:issues,id',
            'name' => 'required|string|max:255',
        ]);

        // try {
        // Find the issue by ID and update the name
        $issue = issue::find($request->id);
        $issue->name = $request->name;
        $issue->save();

        return redirect()->back()->with(['success' => true, 'message' => 'Issue updated successfully.']);
        // } catch (\Exception $e) {
        // Log the error and return a response
        // \Log::error('Error updating issue: ' . $e->getMessage());

        //     return response()->json(['success' => false, 'message' => 'Error updating issue.'], 500);
        // }
    }
    function deleteissues(Request $request, $id)
    {
        $indexing = issue::find($id)->update([
            'active' => 0
        ]);
        return redirect()->back()->with('message', 'Deleted');
    }


    function addIssuesData(Request $request, $id)
    {
        $volume = volumes::where("id", $id)->first();

        $string = str_replace(' ', '-', $request->name);  //replace space
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); //remove special char


        $issues = new issue;

        $issues->name = $request->name;
        $issues->month = $request->month;
        $issues->slug = $slug;
        $issues->v_id = $id;
        // $issues->j_id = $volume->j_id;
        $issues->ip_address = \Request::ip();
        $issues->save();

        $issues = issue::get()->where('v_id', $id);

        return back()->with('message', 'Your request Submitted successfully');
        // return view('adminpanel.add-issues', ['id' => $id, 'issues' => $issues]);
    }

    function addArticle(Request $request, $id)
    {

        $v_id = issue::get()->where('id', $id)->first();

        $article = articles::where('i_id', $id)
            ->where('status', '=', 1)->orderBy('id', 'desc')->get();

        return view('adminpanel.add-article', ['v_id' => $v_id, 'article' => $article, 'id' => $id]);
    }


    function addArticleData(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:500',
            'aname' => 'required|max:500',
            'designation' => 'max:500',
            'doi' => 'max:50',
            'page' => 'max:100',
            'file' => 'required|mimes:pdf,docx',
        ]);


        $namewithextension = $request->file->getClientOriginalName();

        $fileOriginalName = explode('.', $namewithextension)[0];

        $v_id = issue::get()->where('id', $id)->first();

        $j_id = volumes::where('id', $v_id->v_id)->first();

        $file = time() . '.' . $request->file->extension();


        $string = str_replace(' ', '-', $request->name);  //replace space
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); //remove special char

        // check slug 
        $check = articles::where('slug', $slug)->first();
        if ($check) {
            $slug = $slug . '-' . time();
        }

        $articles = new articles;
        $articles->name = $request->name;
        $articles->article_type = $request->article_type;

        $articles->sr_no = $request->sr_no;
        $articles->cited_by = $request->cited_by;
        $articles->language = $request->language;
        $articles->licence = $request->licence;
        $articles->received = $request->received;
        $articles->revised = $request->revised;
        $articles->accepted = $request->accepted;


        $articles->slug = $slug;
        $articles->aname = strip_tags($request->aname);
        $articles->published_date = $request->published_date;
        $articles->googleScholar = $request->googleScholar;
        $articles->abstract = $request->abstract;
        $articles->keywords = $request->keywords;
        $articles->fileOriginalName = $fileOriginalName;
        $articles->designation = strip_tags($request->designation);
        $articles->doi = strip_tags($request->doi);
        $articles->email = strip_tags($request->email);
        $articles->orcid_id = strip_tags($request->orcid_id);
        $articles->page = strip_tags($request->page);
        $articles->file = strip_tags($file);
        $articles->i_id = $id;
        $articles->v_id = $v_id->v_id;
        $articles->j_id = $j_id->j_id;

        $articles->ip_address = \Request::ip();

        $articles->save();
        $request->file->move(base_path('public/assets/articles/'), $file);


        return back()->with('message', 'Added');
    }




    function updateArticle(Request $request, $id)
    {

        $article = articles::find($id);

        return view('adminpanel.update-article', ['articles' => $article]);
    }

    function updateArticleData(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|max:500',
            'aname' => 'required|max:500',
            'designation' => 'max:500',
            'doi' => 'max:50',
            'page' => 'max:100',
            'file' => 'mimes:pdf,docx',
        ]);
        if ($request->file) {

            $namewithextension = $request->file->getClientOriginalName();

            $fileOriginalName = explode('.', $namewithextension)[0];

            $v_id = issue::get()->where('id', $id)->first();

            $file = time() . '.' . $request->file->extension();
        }

        $updateArticle = articles::find($id);
        $updateArticle->name = strip_tags($request->name);
        $updateArticle->aname = strip_tags($request->aname);
        $updateArticle->article_type = strip_tags($request->article_type);


        $updateArticle->sr_no = $request->sr_no;
        $updateArticle->cited_by = $request->cited_by;
        $updateArticle->language = $request->language;
        $updateArticle->licence = $request->licence;
        $updateArticle->received = $request->received;
        $updateArticle->revised = $request->revised;
        $updateArticle->accepted = $request->accepted;
        $updateArticle->abstract = $request->abstract;




        $updateArticle->designation = strip_tags($request->designation);
        $updateArticle->published_date = $request->published_date;
        $updateArticle->googleScholar = $request->googleScholar;
        $updateArticle->keywords = $request->keywords;
        $updateArticle->doi = strip_tags($request->doi);
        $updateArticle->page = strip_tags($request->page);
        if ($request->file) {
            $updateArticle->file = strip_tags($file);
        }

        $updateArticle->ip_address = \Request::ip();

        $updateArticle->update();
        if ($request->file) {
            $request->file->move(base_path('public/assets/articles/'), $file);
        }
        return back()->with('message', 'Your request Submitted successfully');
        // return dd($request->all());
    }

    function Checkjournals()
    {
        $journal = journal::get();

        return view('adminpanel.all-journals', ['journal' => $journal]);
    }

    function updateJournals(Request $request, $id)
    {
        $journal = journal::get()->where('j_id', $id)->first();

        return view('adminpanel.update-journals', ['journal' => $journal]);
    }

    function updateJournalsData(Request $request, $id)
    {

        $journal = journal::where('j_id', '=', $id)->update([
            'j_name' => $request->jname,
            'abbr_title' => $request->abbr,
            'issn' => $request->issn,
            'frequency' => $request->frequency,
            'language' => $request->language,
            'chief_editor' => $request->chief,
            'publisher' => $request->publisher,
            'country_of_origin' => $request->country,
            'aim_and_scope' => $request->aim,
            'subject' => $request->subject,
            'format' => $request->formatOfarticle,
            'starting_year' => $request->starting_year


        ]);
        return redirect('journalForm');
    }

    function book()
    {
        $books = book::get();

        return view('adminpanel.book', ['books' => $books]);
    }

    function addBook(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'editors' => 'required|max:300',
            'scopes' => 'max:1000',
            'photo' => 'required|mimes:jpg, jpeg, png',

        ]);

        $photo = time() . '.' . $request->photo->extension();

        $book = new book;
        $book->title = strip_tags($request->title);
        $book->editors = strip_tags($request->editors);
        $book->scopes = strip_tags($request->scopes);
        $book->photo = strip_tags($photo);

        $book->ip_address = \Request::ip();

        $book->save();
        $request->photo->move(base_path('public/assets/img/books'), $photo);


        return back()->with('message', 'Added');
    }

    function updateJournalPhoto(Request $request)
    {

        $photo = time() . '.' . $request->photo->extension();

        $request->photo->move(base_path('public/assets/journals/img'), $photo);

        $journal = journal::where('j_id', '=', $request->id)->update([
            'photo' => $photo,
        ]);




        return back()->with('message', 'Successfully Updated Image');
    }



    function deleteArticle(Request $request)
    {

        $articles = articles::where('id', '=', $request->id)->update([
            'status' => 0
        ]);
        echo '<h1>  Deleted Successfully... </h1> <p>If this is an accidental delete than please contact <b><i>pageuptechnologies@gmail.com</i></b> and mention this code =<b><i> ARTICLE ' . $request->id . '</i></b>';
    }




    function indexingList($id)
    {
        $indexing = indexings::where('j_id', $id)->where('active', 1)->get();
        $journals = journal::where('j_id', $id)->where('active', 1)->get();
        // return $journals;
        return view('adminpanel.indexing', ['journals' => $journals, 'indexing' => $indexing]);
        // return $indexing;
    }

    function UpdateIndexing(Request $request)
    {
        $indexing = indexings::findOrFail($request->id);

        if ($request->has('link')) {
            $indexing->link = $request->link;
            $indexing->isShowOnHome = $request->has('isShowOnHome') ? 1 : 0;
            $indexing->save();

            return redirect()->back()->with('message', 'Updated');
        }

        if ($request->photo) {
            $photo = time() . '.' . $request->photo->extension();
            $indexing->img = $photo;
            $indexing->save();

            $request->photo->move(base_path('public/assets/indexing/img'), $photo);

            return redirect()->back()->with('message', 'Updated');
        }

        return redirect()->back()->with('message', 'No changes submitted');
    }




    function DeleteIndexing($id)
    {
        $indexing = indexings::find($id)->update([
            'active' => 0
        ]);
        return redirect()->back()->with('message', 'Deleted');
    }


    function changeHomeAsset(Request $request)
    {

        $id = 1;

        if ($request->logo) {

            $photo = time() . '.' . $request->logo->extension();
            // $photo = logo.png;
            $logo = home_asset::find($id)->update([
                'logo' => $photo
            ]);
            $request->logo->move(base_path('public/assets/homeAssets'), $photo);
            return redirect()->back()->with('message', 'Updated');
        }
        if ($request->banner) {

            $photo = time() . '.' . $request->banner->extension();
            // $photo = banner.jpg;
            $banner = home_asset::find($id)->update([
                'banner' => $photo
            ]);
            $request->banner->move(base_path('public/assets/homeAssets'), $photo);
            return redirect()->back()->with('message', 'Updated');
        }
    }

    function makeSlug()
    {

        $all = articles::get();

        $count = 0;
        foreach ($all as $data) {
            if (!$data->slug) {

                $string = str_replace(' ', '-', $data->name);  //replace space
                $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); //remove special char

                // check slug 
                $check = articles::where('slug', $slug)->first();
                if ($check) {
                    $slug = $slug . '-' . time();
                }

                $update = articles::where('id', $data->id)->update([
                    'slug' => $slug
                ]);
                $count = $count + 1;
            }
        }

        return $count . ' data updated';



    }

    function savePageData(Request $request)
    {

        $save = DB::table('pages')->insert([
            'type' => $request->type,
            'data' => $request->data

        ]);
        return redirect()->back()->with('message', 'Updated');

    }

    function addpages($type)
    {

        $data = DB::table('pages')->where('type', $type)->orderBy('id', 'desc')->first();
        return view('adminpanel.pages.' . $type, ['type' => $type, 'data' => $data]);
    }

    function addDynamicPages($type)
    {

        $data = DB::table('pages')->where('type', $type)->orderBy('id', 'desc')->first();
        return view('adminpanel.pages.addDynamicPages', ['type' => $type, 'data' => $data]);
    }



    function custom_pages($path)
    {

        $data = DB::table('custom_pages')
            ->where('path', $path)
            ->where('status', 1)
            ->orderBy('id', 'desc')
            ->first();
        // return $data;
        return view('adminpanel.custom_pages.index', ['data' => $data, 'type' => 'custom_pages']);
    }

    function updateCustomPageData(Request $request)
    {

        $disable_old = DB::table('custom_pages')->where('path', $request->path)->update(['status' => 0]);

        $save = DB::table('custom_pages')->insert([
            'page_title' => $request->page_title,
            'type' => $request->type,
            'path' => $request->path,
            'data' => $request->data,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => 1

        ]);

        return redirect()->back()->with('message', 'Updated');

    }

    function addCustomPageData(Request $request)
    {

        #check if page already exists
        $check = DB::table('custom_pages')->where('path', $request->path)->first();
        if ($check) {
            return redirect()->back()->with('message', 'Page already exists');
        }
        $save = DB::table('custom_pages')->insert([
            'page_title' => $request->page_title,
            'type' => $request->type,
            'path' => $request->path,
            'data' => $request->data,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'status' => 1

        ]);

        return redirect()->back()->with('message', 'Added');
    }


    function manegePages(Request $request)
    {

        $pages = DB::table('custom_pages')
        ->where('type', 'page')
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

        $content = DB::table('custom_pages')
        ->where('type', 'content')
        ->where('status', 1)
        ->orderBy('id', 'desc')
        ->get();

        return view('adminpanel.custom_pages.manegePages', ['pages' => $pages, 'content' => $content]);
    }




}
