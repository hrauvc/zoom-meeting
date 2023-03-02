<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class UpdateRequest extends FormRequest
{

	protected function prepareForValidation()
	{

		$account = $this->meeting->account;

		$env = [
			'account' => $account->account,
			'client' => $account->client,
			'secret' => $account->secret
		];

		$startTime = Carbon::parse($this->start_time)->toIso8601ZuluString();

		$this->merge([
			'start_time' => $startTime
		]);

		$params = $this->only([
			'topic',
			'start_time',
			'duration',
			'timezone',
			'password'
		]);

		$this->merge([
			'params' => $params,
			'env' => $env
		]);

	}

	public function authorize()
	{
		return true;
	}

	public function rules()
	{

		return [];

	}


}