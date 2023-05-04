<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Agent extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFactory;
    protected $casts = [
        'role' => \App\Enum\AgentRoleEnum::class,
    ];
    protected $guarded = ['id'];


    public function full_name()
    {
        return "$this->first_name $this->last_name";
    }

   
    public function is_admin()
    {
        return $this->role == \App\Enum\AgentRoleEnum::ADMIN;
    }

    /**
     * Get all of the comments for the Agent
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function company() : BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
