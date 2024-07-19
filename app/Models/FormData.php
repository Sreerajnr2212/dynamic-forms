<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends Model
{
    use HasFactory;
    
    protected $table = 'form_data';
    protected $fillable = ['form_id', 'form_data'];

    protected $casts = [
        'form_data' => 'array',
    ];
}
