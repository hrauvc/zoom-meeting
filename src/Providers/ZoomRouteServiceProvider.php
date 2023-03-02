<?php

namespace LaravelersAcademy\ZoomMeeting\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class ZoomRouteServiceProvider extends ServiceProvider
{

	public function map()
	{

		if(config('zoom.use_routes')) {

			$this->mapApiRoutes();

		}

	}

	protected function mapApiRoutes()
	{

		Route::middleware('api')
			->prefix('api/zoom')
			->as('api.zoom.')
			->namespace('LaravelersAcademy\ZoomMeeting\Http\Controllers')
			->group(__DIR__ . '/../../routes/api.php');

	}

}