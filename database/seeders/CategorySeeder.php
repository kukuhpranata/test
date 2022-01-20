<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category_id =[1231, 1232, 1233];
        $category_name = ["Category 1", "Category 2", "Category 3"];

        foreach($category_id as $key => $category_id){
            $new_category = Category::first();
            
            $new_category = new Category();
            $new_category->_id = $category_id;
            $new_category->category_name = $category_name[$key];
            $new_category->save();
    }
}
}