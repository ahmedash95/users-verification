<?php

namespace Ahmedash95\UsersVerification;

use Illuminate\Support\ServiceProvider;

class UsersVerificationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish a migration file
        $this->publishes([
            __DIR__.'/../migrations/create_users_tokens_table.php' => base_path("/database/migrations")."/".date('Y_m_d_His')."_create_users_tokens_table.php",
        ], 'migrations');
    }
}