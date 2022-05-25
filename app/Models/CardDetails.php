<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'cc_name',
        'cc_number',
        'cc_expiration',
        'cc_cvv'
    ];
}
