<?php

namespace TypiCMS\Modules\Translations\Providers;

use Illuminate\Foundation\Application;
use Illuminate\Translation\TranslationServiceProvider as LaravelTranslationServiceProvider;
use TypiCMS\Modules\Translations\Loaders\MixedLoader;
use TypiCMS\Modules\Translations\Repositories\TranslationInterface;

class TranslationServiceProvider extends LaravelTranslationServiceProvider
{
    /**
     * Register the translation line loader.
     *
     * @return null
     */
    protected function registerLoader()
    {
        $this->app->singleton('translation.loader', function (Application $app) {
            $repository = $app->make(TranslationInterface::class);

            return new MixedLoader(new \Illuminate\Filesystem\Filesystem(), $app['path.lang'], $repository);
        });
    }
}
