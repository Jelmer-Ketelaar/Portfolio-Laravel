<?php


namespace Database\Seeders;


use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = new Category([
            'name' => 'HTML/CSS',
        ]);
        $category->save();

        $category = new Category([
            'name' => 'PHP',
        ]);
        $category->save();

        $category = new Category([
            'name' => 'Laravel/Symfony',
        ]);
        $category->save();

        $category = new Category([
            'name' => 'HTML/CSS/Javascript',
        ]);
        $category->save();

        $category = new Category([
            'name' => 'C#',
        ]);
        $category->save();
    }
}