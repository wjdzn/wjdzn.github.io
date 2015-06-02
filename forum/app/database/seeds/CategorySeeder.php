<<<<<<< HEAD
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
=======
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
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
