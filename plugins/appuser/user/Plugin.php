<?php

namespace AppUser\User;

use AppUser\User\Http\Middleware\Authenticate;
use System\Classes\PluginBase;

/**
 * Plugin Information File
 *
 * @link https://docs.octobercms.com/3.x/extend/system/plugins.html
 */
class Plugin extends PluginBase
{
    /**
     * pluginDetails about this plugin.
     */
    public function pluginDetails()
    {
        return [
            'name' => 'User',
            'description' => 'No description provided yet...',
            'author' => 'AppUser',
            'icon' => 'icon-leaf'
        ];
    }

    /**
     * register method, called when the plugin is first registered.
     */
    public function register()
    {
            $this->app['router']->aliasMiddleware('userAutheticate', Authenticate::class);
    }

    /**
     * boot method, called right before the request route.
     */
    public function boot()
    {
        //
    }
}
