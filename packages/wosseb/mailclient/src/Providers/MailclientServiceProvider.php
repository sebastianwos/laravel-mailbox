<?php

namespace Wosseb\Mailclient\Providers;

use Ddeboer\Imap\Server;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Wosseb\Mailclient\Commands\SynchronizeMail;
use Illuminate\Support\Facades\View;

class MailclientServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        $this->loadRoutesFrom(__DIR__.'/../routes.php');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        $this->loadViewsFrom(__DIR__.'/../Views/', 'mailclient');

        View::composer(
            'mailclient::folders', 'Wosseb\Mailclient\Http\ViewComposers\FoldersComposer'
        );

        if ($this->app->runningInConsole()) {
            $this->commands([
                SynchronizeMail::class,
            ]);
        }

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('MailboxConnection', function ($app) {
            $server = new Server(('imap.gmail.com'));
            return $server->authenticate(env('MAIL_USERNAME'), env('MAIL_PASSWORD'));
        });

    }
}
