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
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Analytics', 'Ponut\Modules\Services\Backend\Analytics');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Appearance', 'Ponut\Modules\Services\Backend\Appearance');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Notify', 'Ponut\Modules\Services\Backend\Notify');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Plugin', 'Ponut\Modules\Services\Backend\Plugin');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Robot', 'Ponut\Modules\Services\Backend\Robot');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Setup', 'Ponut\Modules\Services\Backend\Setup');
        $this->app->bind( 'Ponut\Modules\Contracts\Backend\Upgrade', 'Ponut\Modules\Services\Backend\Upgrade');

        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Candidate', 'Ponut\Modules\Services\Entities\Candidate');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Department', 'Ponut\Modules\Services\Entities\Department');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Field', 'Ponut\Modules\Services\Entities\Field');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Job', 'Ponut\Modules\Services\Entities\Job');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Option', 'Ponut\Modules\Services\Entities\Option');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Permission', 'Ponut\Modules\Services\Entities\Permission');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Role', 'Ponut\Modules\Services\Entities\Role');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\User', 'Ponut\Modules\Services\Entities\User');
        $this->app->bind( 'Ponut\Modules\Contracts\Entities\Route', 'Ponut\Modules\Services\Entities\Route');

        $this->app->bind( 'Ponut\Modules\Contracts\API\Auth', 'Ponut\Modules\Services\API\Auth');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Request', 'Ponut\Modules\Services\API\Request');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Response', 'Ponut\Modules\Services\API\Response');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Validator', 'Ponut\Modules\Services\API\Validator');
    }
}
