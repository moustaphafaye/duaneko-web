<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Company extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'slug',];


    //Here I want to automatically generate a slug based on a description field

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
    */

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * Get the user that owns the Company
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */

    public function agent() : HasMany
    {
        return $this->hasMany(Agent::class);
    }
}
