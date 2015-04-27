<?php

class UserSeeder extends Seeder
{

    public function run()
    {
        if (User::where('email', 'admin@forumiumpro.tk')->count() < 1) {
            User::create(array(
                'email' => 'admin@forumiumpro.tk',
                'password' => md5('123456' . 'forumiumpro'),
                'first_name' => 'Admin',
                'surname' => 'Admin',
                'country' => 'US',
                'ip' => '127.0.0.1',
                'activated' => 1,
                'membership' => 4
            ));
            Profile::create(array(
                'user_id' => 1
            ));
        }
    }

}
