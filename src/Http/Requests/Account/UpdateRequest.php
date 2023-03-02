<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Requests\Account;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{


	public function authorize()
	{
		return true;
	}

	public function rules()
	{

		return [
			'account' => 'required',
			'client' => 'required',
			'secret' => 'required',
			'owner_id' => 'required'
		];

	}


}