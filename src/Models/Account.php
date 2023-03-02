<?php

namespace LaravelersAcademy\ZoomMeeting\Models;

use LaravelersAcademy\ZoomMeeting\Database\Factories\AccountFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    protected $table = 'zoom_accounts';

    protected $fillable = [
        'account',
        'client',
        'secret',
        'owner_id',
    ];

    protected static function newFactory()
    {
        return AccountFactory::new();
    }

    public function owner()
    {
        return $this->belongsTo(config('zoom.related_owner'), 'owner_id'); 
    }

    public function meetings()
    {
        return $this->hasMany('LaravelersAcademy\ZoomMeeting\Models\Meeting');
    }

}
