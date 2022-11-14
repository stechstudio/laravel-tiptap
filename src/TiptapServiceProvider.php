<?php

declare(strict_types=1);

namespace STS\Tiptap;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\Compilers\BladeCompiler;

class TiptapServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(path: __DIR__ . '/../config/tiptap.php', key: 'tiptap');
    }

    public function boot(): void
    {
        $this->loadViewsFrom(path: __DIR__ . '/../resources/views', namespace: 'tiptap');

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
        Blade::component('tiptap::components.' . $component, 'tiptap-' . $component);
    }

    protected function configurePublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                paths: [
                    __DIR__ . '/../resources/views' => resource_path('views/vendor/tiptap'),
                ],
                groups: 'tiptap-views',
            );
        }
    }
}
