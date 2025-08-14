<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdArt extends Model
{
    use HasFactory;

    protected $table = 'ad_arts';

    protected $fillable = [
        'gambar',
        'pdf',
    ];
}
