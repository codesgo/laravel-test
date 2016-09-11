<?php

namespace Codesgo\Laraback\Providers;

use Illuminate\Support\ServiceProvider;
use \Codesgo\Laraback\Http\Middleware\CheckRole;

class LarabackServiceProvider extends ServiceProvider
{
	/**
	 * Bootstrap the application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->app['router']->middleware('checkrole', CheckRole::class);

		$this->publishes([
			 __DIR__ . '/../../database/migrations' => $this->app->databasePath() . '/migrations'
		], 'migrations');

		$this->publishes([
			__DIR__ . '/../../resources/views' => base_path('resources/views/vendor/laraback')
		], 'views');

		$this->publishes([
			__DIR__ . '/../../config' => config_path()
		], 'config');

		$this->publishes([
			__DIR__ . '/../../resources/assets' => public_path()
		], 'assets');
	}

	/**
	 * Register the application services.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->mergeConfigFrom(
			__DIR__ . '/../../config/laraback.php', 'laraback'
		);

		if (! $this->app->routesAreCached()) {
			require __DIR__ . '/../Support/helpers.php';

			require __DIR__ . '/../../routes/web.php';

			$this->loadViewsFrom(__DIR__ . '/../../resources/views', 'laraback');
		}

	}
}
