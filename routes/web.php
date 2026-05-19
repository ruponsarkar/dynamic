<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\adminPanelController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\PaypalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

Route::get('/', [IndexController::class, 'index']);


Route::get('manuscript', [IndexController::class, 'manuscript']);
Route::get('payments', [IndexController::class, 'payments']);
Route::post('submit_manuscript', [FormController::class, 'submit_manuscript']);
Route::post('paypal/orders', [PaypalController::class, 'createOrder']);
Route::post('paypal/orders/{paypalOrderId}/capture', [PaypalController::class, 'captureOrder']);
Route::get('archives/{slug}', [IndexController::class, 'archives']);
Route::get('archives/{slug}/{v_slug}/{i_slug}', [IndexController::class, 'articles']);
Route::get('journals', [IndexController::class, 'allJournals']);
Route::get('journal/{slug}', [IndexController::class, 'journal']);
Route::get('article/{slug}', [IndexController::class, 'article']);
Route::get('indexings/{slug}', [IndexController::class, 'indexings']);
Route::get('certificates/{slug}', [IndexController::class, 'certificates']);
Route::get('current-issue', [IndexController::class, 'currentIssue']);


Route::get('conference' , [adminPanelController::class,'conference']);

Route::get('editorial-board/{slug}', [IndexController::class, 'editorialBoard']);


Route::get('/join-editor', function () {
    return view('join_editor');
});
Route::get('/join-reviewer', function () {
    return view('join_reviewer');
});

Route::post('submit_editor', action: [FormController::class, 'submit_editor']);
Route::post('submit_reviewer', [FormController::class, 'submit_reviewer']);





Route::post('/register', function () {})->name('registration.submit');
Route::post('/contact', function () {})->name('contact.submit');


Route::group(['middleware' => ['AuthCheck']], function () {

    Route::get('login', [adminPanelController::class, 'login']);
    Route::get('admin_index', [adminPanelController::class, 'adminIndex']);
    Route::get('add-indexing' , [adminPanelController::class,'addIndexingPage']);
    Route::get('add-certificate' , [adminPanelController::class,'addCertificatePage']);

    Route::get('all-manuscript', [adminPanelController::class, 'allManuscript']);
    Route::get('receive-editors', [adminPanelController::class, 'allEditorsRequest']);
    Route::get('receive-reviewers' ,[adminPanelController::class, 'allReviewerRequest']);

    Route::get('journalForm', [adminPanelController::class, 'journalForm']);
    Route::post('addJournal', [adminPanelController::class, 'addJournal']);
    // Route::get('indexing', [adminPanelController::class, 'indexing']);
    Route::post('addIndexing', [adminPanelController::class, 'addIndexing']);
    Route::get('indexingList/{id}', [adminPanelController::class, 'indexingList']);
    Route::post('UpdateIndexing', [adminPanelController::class, 'UpdateIndexing']);
    Route::get('DeleteIndexing/{id}', [adminPanelController::class, 'DeleteIndexing']);
    Route::post('addCertificate', [adminPanelController::class, 'addCertificate']);
    Route::get('certificateList/{id}', [adminPanelController::class, 'certificateList']);
    Route::post('UpdateCertificate', [adminPanelController::class, 'UpdateCertificate']);
    Route::get('DeleteCertificate/{id}', [adminPanelController::class, 'DeleteCertificate']);
    
    Route::get('add-conference', [adminPanelController::class,'addconference']);
    
    Route::post('addConferences' , [adminPanelController::class,'addConferenceinsert']);
    Route::get('update-conference/{id}', [adminPanelController::class,'updateconference']);
    Route::get('delete-conference/{id}', [adminPanelController::class,'deleteconference']);
    Route::post('update-conference/update-conference-data/{id}', [adminPanelController::class,'updateconferenceData']);

    Route::get('viewer/{id}', [adminPanelController::class, 'viewer']);
    Route::get('addEditors', [adminPanelController::class, 'addEditors']);
    Route::post('editors', [adminPanelController::class, 'editors']);

    Route::get('delete_editors/{id}', [adminPanelController::class, 'delete_editors']);

    Route::get('edit_editor/{id}', [adminPanelController::class, 'edit_editor']);
    Route::post('edit_editor/updateEditors/{id}', [adminPanelController::class, 'updateEditors']);

    Route::get('add-volume', [adminPanelController::class, 'addVolume']);
    Route::post('addVolume', [adminPanelController::class, 'addVolumeData']);
    Route::get('add-issues/{id}',  [adminPanelController::class, 'addIssues']);
    Route::post('update-issues',  [adminPanelController::class, 'updateIssues']);
    Route::get('delete-issues/{id}', [adminPanelController::class,'deleteissues']);
    

    Route::post('add-issues/{id}', [adminPanelController::class, 'addIssuesData']);

    Route::get('add-article/{id}', [adminPanelController::class, 'addArticle']);

    Route::post('addArticleData/{id}', [adminPanelController::class, 'addArticleData']);

    Route::get('update-article/{id}', [adminPanelController::class, 'updateArticle']);
    Route::post('update-article/update-article-data/{id}', [adminPanelController::class, 'updateArticleData']);

    Route::get('Checkjournals', [adminPanelController::class, 'Checkjournals']);
    Route::get('update-journals/{id}', [adminPanelController::class, 'updateJournals']);
    Route::post('updateJournalsData/{id}', [adminPanelController::class,'updateJournalsData']);
    Route::post('updateJournalPhoto/{id}', [adminPanelController::class,'updateJournalPhoto']);
    Route::get('delete-journals/{id}', [adminPanelController::class,'deleteJournals']);
    Route::get('delete-article/{id}', [adminPanelController::class, 'deleteArticle']);

    Route::get('book', [adminPanelController::class,'book']);
    Route::post('addBook', [adminPanelController::class,'addBook']);

    // home assets 
    Route::post('changeHomeAsset', [adminPanelController::class,'changeHomeAsset']);


    Route::get('setPages', function(){
        return view('adminpanel.pages.setPages');
    });


    #######################----------------------

    Route::get('manege-pages', [adminPanelController::class, 'manegePages']);
    Route::post('updateCustomPageData', [adminPanelController::class, 'updateCustomPageData']);
    Route::post('addCustomPageData', [adminPanelController::class, 'addCustomPageData']);
    
    Route::get('add-custom', function(){
        return view('adminpanel.custom_pages.add');
    });
    Route::get('custom_pages/{path}', [adminPanelController::class, 'custom_pages']);
    
    #######################----------------------

    Route::get('addAboutUs', function(){
        return view('adminpanel.pages.addAboutUs');
    });

    Route::get('addpages/{type}', [adminPanelController::class, 'addpages']);
    Route::post('savePageData', [adminPanelController::class, 'savePageData']);

    
    
    
    Route::get('newsUpdation', [adminPanelController::class, 'newsUpdation']);
    Route::post('addnews', [adminPanelController::class, 'addnewsData']);

});

Route::post('check', [adminPanelController::class, 'check']);  
Route::post('regis', [adminPanelController::class, 'addAdmin']);
Route::get('register', [adminPanelController::class, 'regis']);
Route::get('logout', [adminPanelController::class, 'logout']);







Route::get('/{path}', [IndexController::class, 'custom_pages']);

