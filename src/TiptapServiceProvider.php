<?php

namespace STS\Tiptap;


use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class TiptapServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/tiptap.php', 'tiptap');
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tiptap');

        $this->configureComponents();
        $this->configurePublishing();
    }

    /**
     * Configure the Tiptap Blade components.
     *
     * @return void
     */
    protected function configureComponents(): void
    {
        $this->callAfterResolving(BladeCompiler::class, function () {
            $this->registerComponent('editor');
        });
    }

    /**
     * Register the given component.
     *
     * @param  string  $component
     * @return void
     */
    protected function registerComponent(string $component): void
    {
        Blade::component('tiptap::components.'.$component, 'tiptap-'.$component);
    }

    /**
     * Configure publishing for the package.
     *
     * @return void
     */
    protected function configurePublishing()
    {
        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__.'/../config/tiptap.php' => config_path('tiptap.php'),
            // ], 'tiptap-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/tiptap'),
            ], 'tiptap-views');
        }
    }
}
