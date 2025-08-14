<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activitie extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'method',
        'value'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}
