<?php 

namespace LaravelersAcademy\ZoomMeeting\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use LaravelersAcademy\ZoomMeeting\Facades\Meeting as ZoomMeeting;

class MeetingFactory extends Factory
{

	protected $model = Meeting::class;

	public function definition()
	{

		$zoomMeeting = ZoomMeeting::set([
			'account' => config('zoom.account'),
			'client' => config('zoom.client'),
			'secret' => config('zoom.secret'),
		])->create([
			'topic' => 'Mi reunión desde Factory',
			'start_time' => '2023-01-27T02:00:00Z',
			'duration' => 60,
			'timezone' => 'America/Mexico_City',
			'password' => '123456789',
			'account_id' => 1
		]);

		return [
			'payload' => $zoomMeeting,
			'account_id' => 1
		];
		
	}

}