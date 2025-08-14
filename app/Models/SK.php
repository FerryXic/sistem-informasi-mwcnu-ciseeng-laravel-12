<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SK extends Model
{
    use HasFactory;

    protected $table = 'sk_items';

    protected $fillable = [
        'gambar',
        'pdf',
        'start_year',
        'end_year',
    ];
}
