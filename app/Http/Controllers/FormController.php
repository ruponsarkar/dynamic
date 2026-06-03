<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\editor;
use App\Models\journal;
use App\Models\manuscripts;
use App\Models\reviewer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Models\Author;

class FormController extends Controller
{
    //for editor form
    function join_editor()
    {
        return view('join_editor');
    }


    function submit_editor(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'mail' => 'required|email',
            'mobile' => 'required|numeric',
            'country' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'specialization' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'affiliation' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'publication' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'cv' => 'required|mimes:pdf,docx',

        ]);

        $photo = time() . '.' . $request->photo->extension();
        $cv = time() . '.' . $request->cv->extension();

        $editor = new editor;
        $editor->name = strip_tags($request->name);
        $editor->email = strip_tags($request->mail);
        $editor->mobile = strip_tags($request->mobile);
        $editor->country = strip_tags($request->country);
        $editor->specialization = strip_tags($request->specialization);
        $editor->affiliation = strip_tags($request->affiliation);
        $editor->publication = strip_tags($request->publication);
        $editor->photo = strip_tags($photo);
        $editor->cv = strip_tags($cv);
        $editor->ip_address = \Request::ip();

        $editor->save();


        $request->photo->move(base_path('public_html/assets/editors/img'), $photo);
        $request->cv->move(base_path('public_html/assets/editors/cv'), $cv);


        return redirect('join-editor')->with('message', 'Your request Submitted successfully');
    }





    // for manuscript 
    function manuscript()
    {
        $journal = journal::select('j_name', 'j_id')
            ->get();

        return view('manuscript', ['journal' => $journal]);
    }

    function submit_manuscript(Request $request)
    {
        $authorAccount = Author::find(session('AuthorLoggedUser'));

        if (!$authorAccount) {
            return redirect()->route('author.login')->with('message', 'Please login as an author to submit manuscript.');
        }

        $request->validate([
            'mode' => 'required|string|max:50',
            'type' => 'required|string|max:80',
            'journal' => 'required|numeric',
            'author' => 'required|string|max:120',
            'affiliation' => 'required|string|max:500',
            'mail' => 'required|email',
            'mobile' => 'required|string|max:30',
            'manuscript' => 'required|string|max:500',
            'file' => 'required|mimes:pdf,docx',
        ]);


        $j_name = journal::where('j_id', $request->journal)
            ->get('j_name')
            ->first();
        $count = \DB::table('manuscript')->count();
        $dater = new Carbon(); 
        $year = date('Y', strtotime($dater));
        $month = date('m', strtotime($dater));
        $file = time() . '.' . $request->file->extension();

        $manuscript = new manuscripts;
        $manuscript->muuid = strip_tags('IJPSM/'.$year.'/'.$month.'/'.$count);
        $manuscript->author_id = $authorAccount->id;
        $manuscript->mode = strip_tags($request->mode);
        $manuscript->type = strip_tags($request->type);
        $manuscript->journal = $j_name->j_name;
        $manuscript->author = strip_tags($request->author);
        $manuscript->affiliation = strip_tags($request->affiliation);
        $manuscript->email = strip_tags($request->mail);
        $manuscript->orcid_id = strip_tags($request->orcid_id);
        $manuscript->mobile = strip_tags($request->mobile);
        $manuscript->manuscript = strip_tags($request->manuscript);
        $manuscript->file = strip_tags($file);

        $manuscript->ip_address = \Request::ip();

        $manuscript->save();


        $request->file->move(base_path('public_html/assets/manuscript'), $file);



        $data = array(
            'muuid' => $manuscript->muuid ,
            'name' => $manuscript->author,
            'email' => $manuscript->email,
            'phone' => $manuscript->mobile,
            'journal' => $manuscript->journal,
            'mode' => $manuscript->mode,
            'type'=>$manuscript->type,
            'title'=>$manuscript->manuscript
        );


        // for user 
        // Mail::send('mails.acknowledge', $data, function ($message) use ($data) {
        //     $message->from('submit@IRASSpublishers.com');
        //     $message->to($data['email']);
        //     $message->subject('Submission Acknowledgement');
        // });

        // for admin 
        // Mail::send('mails.admin', $data, function ($message) use ($data) {
        //     $message->from('submit@IRASSpublishers.com');
        //     $message->to('ruponsarkar108@gmail.com');
        //     $message->subject('New Manuscript Request');
        // });
        

        return redirect('manuscript')->with('message', 'Your request Submitted successfully');
    }


    function reviewer()
    {
        return view('join_reviewer');
    }


    function submit_reviewer(Request $request)
    {

        $request->validate([
            'name' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'mail' => 'required|email',
            'mobile' => 'required|numeric',
            'country' => 'required|regex:/(^[a-zA-Z][a-zA-Z\s]{0,20}[a-zA-Z]$)/',
            'specialization' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'affiliation' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'publication' => 'required|regex:/^([A-Za-z0-9]\s?)+([,]\s?([A-Za-z0-9]\s?)+)*$/',
            'photo' => 'required|mimes:jpeg,jpg,png',
            'cv' => 'required|mimes:pdf,docx',

        ]);

        $photo = time() . '.' . $request->photo->extension();
        $cv = time() . '.' . $request->cv->extension();

        $reviewer = new reviewer;
        $reviewer->name = strip_tags($request->name);
        $reviewer->email = strip_tags($request->mail);
        $reviewer->mobile = strip_tags($request->mobile);
        $reviewer->country = strip_tags($request->country);
        $reviewer->specialization = strip_tags($request->specialization);
        $reviewer->affiliation = strip_tags($request->affiliation);
        $reviewer->publication = strip_tags($request->publication);
        $reviewer->photo = strip_tags($photo);
        $reviewer->cv = strip_tags($cv);
        $reviewer->ip_address = \Request::ip();

        $reviewer->save();


        $request->photo->move(base_path('public_html/assets/reviewers/img'), $photo);
        $request->cv->move(base_path('public_html/assets/reviewers/cv'), $cv);


        return redirect('join-reviewer')->with('message', 'Your request Submitted successfully');
    }
}
