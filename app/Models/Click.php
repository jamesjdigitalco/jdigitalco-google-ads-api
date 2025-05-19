<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Click extends Model
{
    use HasFactory;

    protected $table = 'clicks';

    // Allow mass assignment on these fields
    protected $fillable = [
        'gclid',
        'resource_name',
        'group_ad',
        'group_name',
        'group_id',
        'date_time',
        'account_id',
        'account_name',
        'date_time_no_timezone',
        'conversion_name'
    ];

    // Hide columns
    protected $dates = [
        'created_at',
        'updated_at'
    ];
}
