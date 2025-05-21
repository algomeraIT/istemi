<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Middleware\Authenticate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Model::unguard();
        Carbon::setLocale('it');

        require_once app_path('Helpers/FunctionHelper.php');

        Authenticate::redirectUsing(function ($request) { 
            return route('home'); 
        });

        Builder::macro('filter', function($field, $string) {
            return $string ? $this->where($field, 'like', '%'.strtolower($string).'%') : $this;
        });

        Builder::macro('orFilter', function($field, $string) {
            return $string ? $this->orWhere($field, 'like', '%'.strtolower($string).'%') : $this;
        });

        
    }
}
