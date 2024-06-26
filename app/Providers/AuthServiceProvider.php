<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Models\Graduation;
use App\Models\Skill;
use App\Policies\GraduationPolicy;
use App\Policies\SkillPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
        Skill::class => SkillPolicy::class,
        Graduation::class => GraduationPolicy::class,

    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        //
    }
}
