<?php

use Illuminate\Support\Facades\Route;

# ACCOUNT

Route::post('account/create', 'AccountController@create')
	->name('account.create'); 

Route::get('account/{account}', 'AccountController@show')
	->name('account.show');

Route::put('account/{account}', 'AccountController@update')
	->name('account.update');

Route::delete('account/{account}', 'AccountController@delete')
	->name('account.delete');

# MEETING ROUTES

Route::post('meeting/create', 'MeetingController@create')
	->name('meeting.create');

Route::get('meeting/{meeting}', 'MeetingController@show')
	->name('meeting.show');

Route::put('meeting/{meeting}', 'MeetingController@update')
	->name('meeting.update');

Route::delete('meeting/{meeting}', 'MeetingController@delete')
	->name('meeting.delete');