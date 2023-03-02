<?php

namespace LaravelersAcademy\ZoomMeeting\Models\Traits;

trait ZoomOwner
{

	public function zoom_account()
	{
		return $this->hasOne('LaravelersAcademy\ZoomMeeting\Models\Account');
	}

	public function zoom_accounts()
	{
		return $this->hasMany('LaravelersAcademy\ZoomMeeting\Models\Account');
	}

	public function zoom_meetings()
	{
		return $this->hasManyThrough(
			'LaravelersAcademy\ZoomMeeting\Models\Meeting',
			'LaravelersAcademy\ZoomMeeting\Models\Account',
			'owner_id',
			'account_id'
		);
	}

}