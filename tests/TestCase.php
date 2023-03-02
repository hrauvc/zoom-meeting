<?php

namespace LaravelersAcademy\ZoomMeeting\Tests;

use LaravelersAcademy\ZoomMeeting\Providers\ZoomMeetingServiceProvider;
use LaravelersAcademy\ZoomMeeting\Providers\ZoomRouteServiceProvider;
use Laravel\Sanctum\SanctumServiceProvider;
use Illuminate\Auth\GenericUser;
use Illuminate\Support\Facades\Auth;

class TestCase extends \Orchestra\Testbench\TestCase
{

	public $user;

	public $customEnv;

	public function setUp() : void 
	{

		parent::setUp();

		$migration1 = include __DIR__ . '/../database/migrations/create_zoom_accounts_table.php.stub';
		$migration1->up();

		$migration2 = include __DIR__ . '/../database/migrations/create_zoom_meetings_table.php.stub';
		$migration2->up();

		$this->withFactories(__DIR__ . '/../database/factories');

		$this->user = new GenericUser(['id' => 1, 'name' => 'Test User']);
		Auth::login($this->user);

		$this->customEnv = [
			'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
		];

	}

	protected function getPackageProviders($app)
	{

		return [
			ZoomMeetingServiceProvider::class,
			ZoomRouteServiceProvider::class,
			SanctumServiceProvider::class,
		];

	}

	protected function getEnvironmentSetUp($app)
	{

		$app['config']->set('auth.guards.sanctum', [
			'driver' => 'sanctum',
			'provider' => 'users'
		]);

		$app['config']->set('zoom.account', getenv('zoom_account'));
		$app['config']->set('zoom.client', getenv('zoom_client'));
		$app['config']->set('zoom.secret', getenv('zoom_secret'));

	}

}