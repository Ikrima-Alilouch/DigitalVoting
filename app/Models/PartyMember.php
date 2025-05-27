<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PartyMember extends Model
{
    protected $table = 'partymembers';
    protected $primaryKey = 'partyMemberID';
    
    protected $fillable = [
        'partyID',
        'firstname',
        'infix',
        'lastname',
        'role'
    ];

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class, 'partyID', 'partyID');
    }
} 