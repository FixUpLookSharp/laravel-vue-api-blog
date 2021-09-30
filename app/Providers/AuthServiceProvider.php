<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('chat', function (User $user, Chat $chat) {
            if ($user->id == $chat->subscriber1_id || $user->id == $chat->subscriber2_id) {
                return true;
            }
            return false;
        });

    }


}
