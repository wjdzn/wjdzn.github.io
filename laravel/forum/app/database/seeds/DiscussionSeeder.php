<?php

class DiscussionSeeder extends Seeder
{

    public function run()
    {
        if (Discussion::count() < 2) {
            Discussion::create(array(
                'title' => 'Pro Version',
                'description' => 'The PRO version has many new features',
                'by_id' => 1,
                'cat_id' => 1
            ));
             Discussion::create(array(
                'title' => 'Something Cool',
                'description' => 'So awesomeeeeeee',
                'by_id' => 1,
                'cat_id' => 1
            ));
        }
    }

}
