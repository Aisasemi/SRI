<?php

namespace Aisasemi\SRI;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Aisasemi\SRI\SRI;
use Aisasemi\SRI\Commands\SRIClearCommand;

class SRIServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'aisasemi');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'aisasemi');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
        Blade::directive('sri', function ($arguments) {
            return "<?php echo app('" . SRI::class . "')->get({$arguments}) ?>";
        });
        Blade::directive('htmlsri', function ($arguments) {
            return "<?php echo app('" . SRI::class . "')->html({$arguments}) ?>";
        });
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sri.php', 'sri');

        // Register the service the package provides.
        $this->app->singleton('sri', function ($app) {
            return new SRI;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sri'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sri.php' => config_path('sri.php'),
        ], 'sri.config');

        $this->commands([
            SRIClearCommand::class
        ]);

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/aisasemi'),
        ], 'sri.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/aisasemi'),
        ], 'sri.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/aisasemi'),
        ], 'sri.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
