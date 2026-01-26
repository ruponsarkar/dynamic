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

        View::share([
            'journal' => $journal,
            'assets' => $HomeAssets,
            // 'banner' => $HomeAssets->banner
        ]);
        // View::share();
    }
}
