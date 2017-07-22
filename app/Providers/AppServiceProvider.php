<?php

namespace Ponut\Providers;

use Illuminate\Support\ServiceProvider;
use Ponut\Libraries\Utils\CustomValidations;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        CustomValidations::instance()->defineRules();
        # For More Info Why This https://laravel.com/docs/5.4/migrations
        # Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind( 'Ponut\Modules\Contracts\Analytics', 'Ponut\Modules\Services\Analytics');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend', 'Ponut\Modules\Services\Backend');
        $this->app->bind( 'Ponut\Modules\Contracts\Candidate', 'Ponut\Modules\Services\Candidate');
        $this->app->bind( 'Ponut\Modules\Contracts\Department', 'Ponut\Modules\Services\Department');
        $this->app->bind( 'Ponut\Modules\Contracts\Field', 'Ponut\Modules\Services\Field');
        $this->app->bind( 'Ponut\Modules\Contracts\Frontend', 'Ponut\Modules\Services\Frontend');
        $this->app->bind( 'Ponut\Modules\Contracts\Job', 'Ponut\Modules\Services\Job');
        $this->app->bind( 'Ponut\Modules\Contracts\Option', 'Ponut\Modules\Services\Option');
        $this->app->bind( 'Ponut\Modules\Contracts\Permission', 'Ponut\Modules\Services\Permission');
        $this->app->bind( 'Ponut\Modules\Contracts\Robot', 'Ponut\Modules\Services\Robot');
        $this->app->bind( 'Ponut\Modules\Contracts\Role', 'Ponut\Modules\Services\Role');
        $this->app->bind( 'Ponut\Modules\Contracts\Setup', 'Ponut\Modules\Services\Setup');
        $this->app->bind( 'Ponut\Modules\Contracts\Upgrade', 'Ponut\Modules\Services\Upgrade');
        $this->app->bind( 'Ponut\Modules\Contracts\User', 'Ponut\Modules\Services\User');
        $this->app->bind( 'Ponut\Modules\Contracts\Notify', 'Ponut\Modules\Services\Notify');
        $this->app->bind( 'Ponut\Modules\Contracts\Plugin', 'Ponut\Modules\Services\Plugin');
        $this->app->bind( 'Ponut\Modules\Contracts\Appearance', 'Ponut\Modules\Services\Appearance');
        $this->app->bind( 'Ponut\Modules\Contracts\Route', 'Ponut\Modules\Services\Route');
    }
}
