<?php

namespace Ferranfg\Laravextra;

use Illuminate\Support\ServiceProvider;
use Illuminate\Html\FormBuilder;
use Illuminate\Html\HtmlBuilder;

class LaravextraServiceProvider extends ServiceProvider
{
	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->singleton('form', function($app)
		{
			$form = new FormBuilder($app['html'], $app['url'], $app['session.store']->getToken());

			return $form->setSessionStore($app['session.store']);
		});

		$this->app->singleton('html', function($app)
		{
			return new HtmlBuilder($app['url']);
		});
	}

}