<?php

namespace Specter;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider as BaseProvider;
use Specter\Facades\Ghost;
use Specter\Models\Setting;
use Specter\Models\Tag;

class ServiceProvider extends BaseProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootBladeDirectives();
        $this->bootConfig();

        if (!$this->app->environment('testing')) {
            $this->bootViewGlobals();
        }
    }

    /**
     * Load/publish config.
     *
     * @return void
     */
    protected function bootConfig()
    {
        $srcPath = specter_path('config/specter.php');
        $pubPath = config_path('specter.php');

        $this->mergeConfigFrom($srcPath, 'specter');
        $this->publishes([$srcPath => $pubPath]);
    }

    /**
     * Registers blade directives.
     *
     * @return void
     */
    protected function bootBladeDirectives()
    {
        Blade::directive('markdown', function (string $markdown) {
            $html = Markdown::convertToHtml($markdown);
            return "<?php echo $html; ?>";
        });

        Blade::if('labs', function (string $feature) {
            return Ghost::labs($feature);
        });
    }

    /**
     * Register view globals.
     *
     * @return void
     */
    protected function bootViewGlobals()
    {
        View::share('blog', Ghost::except(['labs', 'slack', 'unsplash'])->type('blog'));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Settings::class, function () {
            $settings = Setting::select('key', 'type', 'value')
                ->whereNotIn('type', ['core', 'private'])
                ->get()
                ->keyBy('key')
                ->toArray();

            return new Settings($settings);
        });
    }
}
