<?php

namespace Database\Seeders;

use App\Models\SousCategory;
use App\Models\SubCategory;
use Illuminate\Database\Seeder;

class SousCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SubCategory::factory()->count(50)->create();
    }
}
