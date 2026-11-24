<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Providers;

use iEducar\Packages\BuritiEscolarAderencia\Console\Onda1EscolarDemoCommand;
use Illuminate\Support\ServiceProvider;

class EscolarAderenciaServiceProvider extends ServiceProvider
{
    public const string PACKAGE = 'buriti/i-educar-escolar-aderencia-package';

    public function register(): void
    {
        // Services são value objects — instanciar com `new` nos callers (não bind no container).
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([Onda1EscolarDemoCommand::class]);
        }
    }
}
