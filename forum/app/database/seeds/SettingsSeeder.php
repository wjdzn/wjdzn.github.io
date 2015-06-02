<<<<<<< HEAD
<?php

/**
 * 
 */
class SettingsSeeder extends Seeder
{

    public function run()
    {
        if (Settings::count() < 1) {
            $data = array(
                'title' => 'Forumium Pro v1',
                'description' => 'Forumium Pro v1 is extended version of Forumium. It has a lot of new features. You can integrate AdSense.',
                'keywords' => 'forum, pro, forumium, codecanyon, cc, scripts, php',
                'theme' => 'mambo',
                'tos' => 0,
                'acc_activation' => 0,
                'max_pic_upload_size' => 512
            );
            Settings::create($data);
        }
    }

}
=======
<?php

/**
 * 
 */
class SettingsSeeder extends Seeder
{

    public function run()
    {
        if (Settings::count() < 1) {
            $data = array(
                'title' => 'Forumium Pro v1',
                'description' => 'Forumium Pro v1 is extended version of Forumium. It has a lot of new features. You can integrate AdSense.',
                'keywords' => 'forum, pro, forumium, codecanyon, cc, scripts, php',
                'theme' => 'mambo',
                'tos' => 0,
                'acc_activation' => 0,
                'max_pic_upload_size' => 512
            );
            Settings::create($data);
        }
    }

}
>>>>>>> f9eb8f2935e210dc911e20d1ac3f5a5339b5f8e8
