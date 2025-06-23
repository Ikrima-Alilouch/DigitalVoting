<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Party extends Model
{
    use HasFactory;

    protected $primaryKey = 'partyID';
    protected $table = 'parties';
    public $timestamps = true;

    protected $fillable = [
        'logo',
        'name',
        'description',
        'status',
        'leader_firstname',
        'leader_infix',
        'leader_lastname',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(PartyMember::class, 'partyID', 'partyID');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(User_Vote::class, 'partyID', 'partyID');
    }
}
