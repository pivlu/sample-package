<?php

namespace Pivlu\SamplePackage;

use Illuminate\Support\ServiceProvider;
use Pivlu\SamplePackage\Console\Commands\SampleCommand;
use Pivlu\SamplePackage\Http\Middleware\SampleMiddleware;

class SamplePackageServiceProvider extends ServiceProvider
{

   public function boot()
   {
      // Register our package's middleware.
      $this->app['router']->aliasMiddleware('sample.middleware', SampleMiddleware::class);
      
      // Publish configuration file.
      $this->publishes([
         __DIR__ . '/config/sample-package.php' => config_path('pivlu/sample-package.php'),
      ], 'config');

      // Register migrations.
      $this->loadMigrationsFrom(__DIR__ . '/migrations');

      // Register routes.
      $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

      // Register views.
      $this->loadViewsFrom(__DIR__ . '/resources/views', 'pivlu/sample-package');

      // Publish assets.
      $this->publishes([
         __DIR__ . '/resources/assets/' => public_path('packages/pivlu/sample-package'),
      ], 'assets'); // <- The tag ("assets") is defined here will be used in `php artisan vendor:publish --tag=assets` command.

      // Publish migrations.
      $this->publishes([
         __DIR__ . '/migrations' => database_path('migrations'),
      ], 'migrations');  // <- The tag ("migrations") is defined here will be used in `php artisan vendor:publish --tag=migrations` command.

      // Publish migrations.
      $this->publishes([
         __DIR__ . '/resources/views' => resource_path('views/vendor/pivlu/sample-package'),
      ], 'views');  // <- The tag ("views") is defined here will be used in `php artisan vendor:publish --tag=views` command.

      // Add package in database
      \App\Models\Plugin::install(self::PLUGIN_VENDOR . '/' . self::PLUGIN_NAME);

      if ($this->app->runningInConsole()) {
         // Register commands.
         $this->commands([
            SampleCommand::class,
         ]);
      }
   }


   public function register()
   {
      // Merge configuration.
      $this->mergeConfigFrom(
         __DIR__ . '/config/sample-package.php',
         'sample-package'
      );
   }
}
