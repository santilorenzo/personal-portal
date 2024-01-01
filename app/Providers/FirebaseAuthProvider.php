<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Kreait\Firebase\Auth\UserRecord;

class FirebaseAuthProvider extends ServiceProvider
{
    public function boot()
    {
        $this->app['auth']->extend('firebase', function ($app, $name, array $config) {
            return new FirebaseUserProvider(
                Firebase::auth(),
                $app['hash'],
                $config['model'] ?? null
            );
        });
    }
}

