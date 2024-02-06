<?php

namespace AppAuth\Auth;

use Backend;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\GoogleProvider;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    public $require = ['AppUser.User'];
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'Auth',
            'description' => 'No description provided yet...',
            'author' => 'AppAuth',
            'icon' => 'icon-leaf'
        ];
    }

    public function boot()
    {
        Socialite::extend('google', function ($app) {
            $config = $this->app['config']['services.google'];

            return Socialite::buildProvider(GoogleProvider::class, $config);
        });
    }
}