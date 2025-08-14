<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryOs extends Model
{
    use HasFactory;

    protected $table = 'category_os';

    protected $fillable = ['name'];

    public function organizationalStructures()
    {
        return $this->hasMany(OrganizationalStructure::class, 'category_id');
    }
}
