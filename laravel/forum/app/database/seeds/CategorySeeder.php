<?php

class CategorySeeder extends Seeder
{

    public function run()
    {
        if (Category::count() < 2) {
            Category::create(array('name' => 'Cars', 'description' => 'All about cars.', 'min_membership' => 1));
            Category::create(array('name' => 'Forumium Pro v1', 'description' => 'Forumium Pro v1', 'min_membership' => 1));
        }
    }

}
