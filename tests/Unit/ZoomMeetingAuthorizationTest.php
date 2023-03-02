<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Unit;

use LaravelersAcademy\ZoomMeeting\Tests\TestCase;
use LaravelersAcademy\ZoomMeeting\Zoom\Authorization;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomAuthorizationException;

class ZoomMeetingAuthorizationTest extends TestCase
{

	/** @test */
	public function testSetMethod()
	{

		$authorization = new Authorization;

		$params = [

			'account' => getenv('zoom_account'),

			'client' => getenv('zoom_client'),

			'secret' => getenv('zoom_secret')

		];

		$response =  $authorization->set($params);

		$this->assertInstanceOf(Authorization::class, $response);

	}

	/** @test */
	public function testSetMethodFailure()
	{

		$this->expectException(ZoomAuthorizationException::class);

		$authorization = new Authorization;

		$params = [

			'account' => getenv('zoom_account'),

			'client' => getenv('zoom_client'),

			'secret' => 'error'

		];

		$authorization->set($params);

	}

}