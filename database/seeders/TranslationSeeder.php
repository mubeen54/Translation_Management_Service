<?php

namespace Database\Seeders;

use App\Models\Transaltion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TranslationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Transaltion::factory()->count(100000)->create();
    }
}
