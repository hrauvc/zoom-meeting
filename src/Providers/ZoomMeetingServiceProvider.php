<?php

namespace LaravelersAcademy\ZoomMeeting\Providers;

use Illuminate\Support\ServiceProvider;
use LaravelersAcademy\ZoomMeeting\Zoom\Meeting;

class ZoomMeetingServiceProvider extends ServiceProvider
{

	public function register()
	{

		$this->app->bind('meeting', function($app) {
            return new Meeting();
        });

        $this->mergeConfigFrom(__DIR__ . '/../../config/zoom.php', 'zoom');

	}

	public function boot()
	{

		if($this->app->runningInConsole()) {

			$this->publishes([
				__DIR__ . '/../../config/zoom.php' => config_path('zoom.php')
			], 'config');

			$this->publishes([
				__DIR__ . '/../../database/migrations/create_zoom_account_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_zoom_account_table.php'),
				__DIR__ . '/../../database/migrations/create_zoom_meetings_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_zoom_meetings_table.php'),
				// ...
			], 'migrations');

		}

	}

}