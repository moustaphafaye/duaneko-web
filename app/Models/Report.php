<?php

namespace App\Models;

use App\Enum\ReportStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'type',
        'latitude',
        'longitude',
        'status',
        'description',
        'user_id'
    ];

    protected $casts = [
        'status' => ReportStatusEnum::class
    ];
}
