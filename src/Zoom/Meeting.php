<?php

namespace LaravelersAcademy\ZoomMeeting\Zoom;

use LaravelersAcademy\ZoomMeeting\Zoom\Authorization;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use LaravelersAcademy\ZoomMeeting\Exceptions\ZoomMeetingValidationException;

class Meeting extends Authorization
{

	public function hola()
	{

		return 'Hola Mundo!';

	}

	public function get($meetingId)
	{

		$this->checkEnv();

		$url = $this->baseUrl . 'meetings/' . $meetingId;

		$response = Http::withToken($this->accessToken)
			->get($url)
			->json();

		return $response;

	}

	/**
	 * - topic
	 * - start_time 
	 * - duration 
	 * - timezone
	 * - password 
	 **/
	public function create(array $data)
	{

		$this->checkEnv();

		$this->validate($data);

		$url = $this->baseUrl . 'users/me/meetings';

		$data = json_encode($data);

		$response = Http::withToken($this->accessToken)
			->withHeaders([
				'content-type' => 'application/json'
			])
			->withBody($data, 'application/json')
			->post($url)
			->json();

		return $response;

	}

	public function update(int $meetingId, array $data)
	{

		$this->checkEnv();

		$this->validate($data);

		$url = $this->baseUrl . 'meetings/' . $meetingId;

		$data = json_encode($data);

		Http::withToken($this->accessToken)
			->withHeaders([
				'content-type' => 'application/json'
			])
			->withBody($data, 'application/json')
			->patch($url)
			->json();

		$response = $this->get($meetingId);

		return $response;

	}

	public function delete($meetingId)
	{

		$this->checkEnv();

		$url = $this->baseUrl . 'meetings/' . $meetingId;

		$response = Http::withToken($this->accessToken)
			->delete($url)
			->status();

		return ($response == 204);

	}

	private function validate(array $data)
	{

		$validator = Validator::make($data, config('zoom.meeting_validation'));

		if($validator->fails()) {

			throw new ZoomMeetingValidationException($validator);

		}

	}

}