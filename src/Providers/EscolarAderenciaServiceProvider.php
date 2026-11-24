<?php

namespace iEducar\Packages\BuritiEscolarAderencia\Providers;

use iEducar\Packages\BuritiEscolarAderencia\Console\Onda1EscolarDemoCommand;
use iEducar\Packages\BuritiEscolarAderencia\Services\FluxoEscolarPoC;
use iEducar\Packages\BuritiEscolarAderencia\Services\MarcaDagua;
use iEducar\Packages\BuritiEscolarAderencia\Services\UniformeMedidas;
use Illuminate\Support\ServiceProvider;

class EscolarAderenciaServiceProvider extends ServiceProvider
{
    public const string PACKAGE = 'buriti/i-educar-escolar-aderencia-package';

    public function register(): void
    {
        $this->app->singleton(MarcaDagua::class);
        $this->app->singleton(UniformeMedidas::class);
        $this->app->singleton(FluxoEscolarPoC::class);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([Onda1EscolarDemoCommand::class]);
        }
    }
}
