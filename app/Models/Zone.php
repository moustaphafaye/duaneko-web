<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Zone extends Model
{
    use HasFactory;
    use HasFactory;
    protected $fillable = [
        'name',
        'latitude',
        'longitude',
        
    ];

    public function company(): BelongsTo
    {
        // return $this->belongsTo(Company::class);
        return $this->belongsTo(Company::class);
    }
}
