<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Unit;

use LaravelersAcademy\ZoomMeeting\Tests\TestCase;
use LaravelersAcademy\ZoomMeeting\Zoom\Meeting as ZoomMeeting;
use LaravelersAcademy\ZoomMeeting\Facades\Meeting;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomMeetingValidationException;

class MeetingClassTest extends TestCase
{

	/** @test */
	public function testHolaMethodReturnsHolaMundo()
	{

		$meeting = new ZoomMeeting();

		$result = $meeting->hola();

		$this->assertEquals('Hola Mundo!', $result);

	}

	/** @test */
	public function testHolaMethodReturnsHolaMundoFromFacade()
	{

		$result = Meeting::hola();

		$this->assertEquals('Hola Mundo!', $result);

	}

	/** @test */
	public function testGetMethodWithCustomCredentials()
	{

		$meetingId = getenv('zoom_meeting_id');

		$response = Meeting::set($this->customEnv)->get($meetingId);

		$this->assertEquals($response['id'], $meetingId);

	}

	/** @test */
	public function testGetMethodWithGlobalCredentials()
	{

		$meetingId = getenv('zoom_meeting_id');

		$response = Meeting::get($meetingId);

		$this->assertEquals($response['id'], $meetingId);

	}

	/** @test */
	public function testCreateMeetingWithCustomCredentials()
	{

		$data = [
			'topic' => 'Mi reunión desde la API',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$response = Meeting::set($this->customEnv)->create($data);

		$this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testCreateMeetingWithGlobalCredentials()
	{

		$data = [
			'topic' => 'Mi reunión desde la API',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$response = Meeting::create($data);

		$this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testCreateMeetingWithGlobalCredentialsFailure()
	{

		$this->expectException(ZoomMeetingValidationException::class);

		$data = [
			//'topic' => 'Mi reunión desde la API',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$response = Meeting::create($data);

		$this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testUpdateMeetingWithCustomCredentials()
	{

		$meetingId = getenv('zoom_meeting_id');

		$data = [
			'topic' => 'Mi reunión desde la API (actualizada)',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$response = Meeting::set($this->customEnv)
			->update($meetingId, $data);

		$this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testUpdateMeetingWithGlobalCredentials()
	{

		$meetingId = getenv('zoom_meeting_id');

		$data = [
			'topic' => 'Mi reunión desde la API (actualizada)',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$response = Meeting::update($meetingId, $data);

		$this->assertEquals($response['topic'], $data['topic']);

	}

	/** @test */
	public function testDeleteMethod()
	{

		$data = [
			'topic' => 'Mi reunión desde la API',
			'start_time' => '2023-01-27T02:00:000Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789'
		];

		$meeting = Meeting::create($data);

		$response = Meeting::delete($meeting['id']);

		$this->assertTrue($response);

	}

}