<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
    use HasFactory;

    protected $table = 'organizational_structures';
    
    protected $fillable = [
        'full_name',
        'category_id',
        'position',
        'image',
        'start_year',
        'end_year',
    ];

    public function category()
    {
        return $this->belongsTo(CategoryOs::class, 'category_id');
    }
}
