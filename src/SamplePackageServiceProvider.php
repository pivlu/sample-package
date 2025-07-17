<?php

namespace Pivlu\SamplePackage;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Pivlu\SamplePackage\Console\Commands\SampleCommand;
use Pivlu\SamplePackage\Http\Middleware\SampleMiddleware;


class MyPackageServiceProvider extends ServiceProvider
{
   
   public function boot()
   {
      // Register our package's middleware.
      $this->app['router']->aliasMiddleware('sample.middleware', SampleMiddleware::class);

      // Publish configuration file.
      $this->publishes([
         __DIR__ . '/config/sample-package.php' => config_path('sample-package.php'),
      ], 'config');

      // Register migrations.
      $this->loadMigrationsFrom(__DIR__ . '/migrations');

      // Register routes.
      $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

      // Register views.
      $this->loadViewsFrom(__DIR__ . '/resources/views', 'sample-package');

      // Publish assets.
      $this->publishes([
         __DIR__ . '/resources/assets/' => public_path('packages/sample-package'),
      ], 'assets');

      // Publish assets.
      $this->publishes([
         __DIR__ . '/migrations' => database_path('migrations'),
      ], 'migrations');  // <- The tag is defined here will be used in `php artisan vendor:publish --tag=HERE` command.

      // Register commands.
      if ($this->app->runningInConsole()) {
         $this->commands([
            SampleCommand::class,
         ]);
      }
   }

   public function register()
   {
      // Merge configuration.
      $this->mergeConfigFrom(
         __DIR__ . '/config/my-package.php',
         'my-package'
      );
   }
}
