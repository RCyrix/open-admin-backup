<?php

namespace OpenAdmin\Backup;

use Illuminate\Support\ServiceProvider;

class BackupServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Backup $extension)
    {

        if (! Backup::boot()) {
            return ;
        }



        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'open-admin-backup');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/open-admin-ext/open-admin-backup')],
                'open-admin-backup'
            );
        }

        $this->app->booted(function () {
            Backup::routes(__DIR__.'/../routes/web.php');
        });
    }
}
