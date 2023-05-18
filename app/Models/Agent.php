<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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

    public function is_agent()
    {
        return $this->role == \App\Enum\AgentRoleEnum::AGENT;
    }

    public function is_admin_agent()
    {
        return $this->role == \App\Enum\AgentRoleEnum::ADMIN_AGENT;
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

    public function evenement() : HasMany
    {
        return $this->hasMany(Evenement::class);
    }
}
