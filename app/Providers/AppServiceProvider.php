<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $commit = DB::table('pushes')->orderBy('id', 'desc')->where('is_deployed', 1)->first();

        $commit = json_decode($commit->payload, true);
        view()->share('latest_commit', $commit);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
