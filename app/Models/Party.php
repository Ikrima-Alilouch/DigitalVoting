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
        'name',
        'description',
        'status',
        'logo',
        'leader_firstname',
        'leader_infix',
        'leader_lastname',
    ];

    public function members(): HasMany
    {
        return $this->hasMany(PartyMember::class, 'partyID', 'partyID');
    }
}
