<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\home_asset;
use DB;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // $HomeAssets = DB::table('home_assets')->where('active', 1)->first();
        $HomeAssets = DB::table('home_assets')->where('active', 1)->first();

        $journal = DB::table('journals')->where('active', 1)->first();
        $journals = DB::table('journals')->where('active', 1)->get();
        $top_editors = DB::table('editors_data')->where('is_top_editor', 1)->where('active', 1)->get();

        View::share([
            'journal' => $journal,
            'assets' => $HomeAssets,
            'journals'=> $journals,
            'top_editors' => $top_editors
            // 'banner' => $HomeAssets->banner
        ]);
        // View::share();
    }
}
