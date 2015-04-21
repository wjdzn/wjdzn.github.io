<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();

        $this->call('SettingsSeeder');
        $this->call('CategorySeeder');
        $this->call('TosSeeder');
        $this->call('DiscussionSeeder');
        $this->call('UserSeeder');
    }

}
