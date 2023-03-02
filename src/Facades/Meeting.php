<?php

namespace LaravelersAcademy\ZoomMeeting\Facades;

use Illuminate\Support\Facades\Facade;

class Meeting extends Facade
{

	protected static function getFacadeAccessor()
	{

		return 'meeting';

	}

}