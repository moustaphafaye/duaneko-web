<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evenement extends Model
{
    use HasFactory;
    protected $fillable =[
        'nom',
        'description',
        'date_evenement',
        'agent_id',
        'heure_evenement'
    ];

    public function agent() : BelongsTo
    {
        return $this->belongsTo(Agent::class);
    }
}
