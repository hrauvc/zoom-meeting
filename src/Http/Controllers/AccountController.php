<?php

namespace LaravelersAcademy\ZoomMeeting\Http\Controllers;

use LaravelersAcademy\ZoomMeeting\Models\Account;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\CreateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\ShowRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\UpdateRequest;
use LaravelersAcademy\ZoomMeeting\Http\Requests\Account\DeleteRequest;
use Illuminate\Http\Request;

class AccountController extends Controller
{

	public function __construct()
	{

		$this->middleware(config('zoom.middlewares'));

	}

	public function create(CreateRequest $request)
	{

		return Account::create($request->all());

	}

	public function show(ShowRequest $request, Account $account)
	{

		return $account;

	}

	public function update(UpdateRequest $request, Account $account)
	{

		return $account->update($request->all());

	}

	public function delete(DeleteRequest $request, Account $account)
	{

		return $account->delete();

	}

}