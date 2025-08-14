<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryOs;

class CategoryOsSeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'TANFIZIYAH',
            'SYURIAH',
            'MUSTASYAR',
            'AWAN',
        ];

        foreach ($categories as $name) {
            CategoryOs::firstOrCreate(['name' => $name]);
        }
    }
}
