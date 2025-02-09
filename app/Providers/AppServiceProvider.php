<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


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
        DB::listen(function ($query) {
            if (str_starts_with(strtolower($query->sql), 'select')) {
                Log::info('Executed: ' . $query->sql);
            }
        });

        try {
            DB::connection()->getPdo();
            Log::info('Database Connection: Successful');
        } catch (\Exception $e) {
            Log::error('Database Connection: Failed - ' . $e->getMessage());
        }
    }
}
