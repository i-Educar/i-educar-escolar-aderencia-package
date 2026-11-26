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
        // Fora de runningInConsole(): o check do Ambiente Laguna (HTTP) usa Artisan::all().
        $this->commands([Onda1EscolarDemoCommand::class]);
    }

    public function boot(): void
    {
        //
    }
}
