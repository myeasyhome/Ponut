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
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Analytics', 'Ponut\Modules\Services\API\Action\Analytics');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Appearance', 'Ponut\Modules\Services\API\Action\Appearance');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Notify', 'Ponut\Modules\Services\API\Action\Notify');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Plugin', 'Ponut\Modules\Services\API\Action\Plugin');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Robot', 'Ponut\Modules\Services\API\Action\Robot');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Setup', 'Ponut\Modules\Services\API\Action\Setup');
        $this->app->bind( 'Ponut\Modules\Contracts\API\Action\Upgrade', 'Ponut\Modules\Services\API\Action\Upgrade');

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
