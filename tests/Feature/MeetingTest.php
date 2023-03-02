<?php

namespace LaravelersAcademy\ZoomMeeting\Tests\Feature;

use LaravelersAcademy\ZoomMeeting\Tests\TestCase;
use LaravelersAcademy\ZoomMeeting\Models\Account;
use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class MeetingTest extends TestCase
{

	use RefreshDatabase, WithFaker;

	/** @test */
	public function testCreateMeeting()
	{

		$account = Account::factory()->create([
			'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
		]);

		$data = [
			'topic' => 'Mi reunión desde el test MeetingTest',
			'start_time' => '2023-02-23T02:00:00Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789',
			'account_id' => $account->id
		];

		$this->postJson("api/zoom/meeting/create", $data)
			->assertStatus(201);

		$this->assertDatabaseHas('zoom_meetings', ['account_id' => $account->id]);

	}

	/** @test */
	public function testShowMeeting()
	{

		$account = Account::factory()->create([
			'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
		]);

		$meeting = Meeting::factory()->create(['account_id' => $account->id]);

		$this->getJson("api/zoom/meeting/$meeting->id")
			->assertStatus(200)
			->assertJsonFragment([
				"id" => $meeting->id
			]);

	}

	/** @test */
	public function testUpdateMeeting()
	{

		$account = Account::factory()->create([
			'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
		]);

		$meeting = Meeting::factory()->create(['account_id' => $account->id]);

		$data = [
			'topic' => 'Mi reunión desde el test MeetingTest',
			'start_time' => '2023-02-23T02:00:00Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789',
			'meeting_id' => $meeting->id
		];

		$this->putJson("/api/zoom/meeting/$meeting->id", $data)
			->assertStatus(200);

		$this->assertDatabaseHas('zoom_meetings', ['account_id' => $account->id]);

	}

	/** @test */
	public function testDeleteMethod()
	{

		$account = Account::factory()->create([
			'account' => getenv('zoom_account'),
			'client' => getenv('zoom_client'),
			'secret' => getenv('zoom_secret'),
		]);

		$meeting = Meeting::factory()->create(['account_id' => $account->id]);

		$this->deleteJson("/api/zoom/meeting/$meeting->id")
			->assertStatus(200);

		$this->assertDatabaseMissing('zoom_meetings', [
			'id' => $meeting->id
		]);

	}

}