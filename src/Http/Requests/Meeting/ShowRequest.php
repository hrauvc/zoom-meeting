<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Meeting;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use LaravelersAcademy\ZoomMeeting\Models\Meeting;
use Illuminate\Foundation\Http\FormRequest;

class ShowRequest extends FormRequest
{

	protected function prepareForValidation()
	{

		$account = $this->meeting->account;

		$env = [
			'account' => $account->account,
			'client' => $account->client,
			'secret' => $account->secret,
		];

		$this->merge([
			'env' =>  $env
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