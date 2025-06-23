<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Vote extends Model
{
    protected $table = 'user_vote';
    public $timestamps = true;

    protected $fillable = [
        'partyID',
        'id', // This is the user ID
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'partyID', 'partyID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
