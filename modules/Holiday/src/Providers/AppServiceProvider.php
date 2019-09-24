<?php

/*
 * This file is part of ibrand/EC-Open-Core.
 *
 * (c) iBrand <https://www.ibrand.cc>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace iBrand\HolidayAvatar\Server\Providers;

use Illuminate\Support\ServiceProvider;
use Route;

class AppServiceProvider extends ServiceProvider
{
    protected $namespace = 'iBrand\HolidayAvatar\Server\Http\Controllers';

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../../migrations');
        }
    }

    public function register()
    {

    }

    public function map()
    {
        Route::prefix('api')
            ->middleware(['api', 'cors'])
            ->namespace($this->namespace)
            ->group(__DIR__.'/../Http/routes.php');
    }

    protected function mapApiRoute()
    {
        Route::middleware(['web'])
            ->namespace($this->namespace)
            ->group(function ($router){
                $router->get('oauth/wxlogin', 'AuthController@wxlogin')->name('api.oauth.wxlogin');
                $router->get('oauth/getUerInfo', 'AuthController@getUerInfo')->name('api.oauth.getUerInfo');
            });
    }


}
