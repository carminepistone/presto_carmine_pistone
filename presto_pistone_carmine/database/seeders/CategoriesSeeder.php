<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
public $categories = [
    'elettronica',
    'abbigliamento',
    'salute_e_bellezza',
    'casa_e_giardinaggio',
    'giocattoli',
    'sport',
    'animali_domestici',
    'libri_e_riviste',
    'accessori',
    'motori'
];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

          foreach ($this->categories as $category) {
            Category::create([
                'name'=> $category,
            ]);
          }  
    }
}
