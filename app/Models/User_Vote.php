<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User_Vote extends Model
{
    protected $primaryKey = 'partyID';
    protected $table = 'parties';
    public $timestamps = true;

    protected $fillable = [
        'partyID',
        'userID',
    ];

    public function party()
    {
        return $this->belongsTo(Party::class, 'partyID', 'partyID');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userID', 'id');
    }
}
