<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Call extends Model
{
    use HasFactory;

    protected $table = 'calls';

    // Allow mass assignment on these fields
    protected $fillable = [
        'contact_id',
        'location_id',
        'timestamp',
        'conversation_id',
        'converted'
    ];
}
