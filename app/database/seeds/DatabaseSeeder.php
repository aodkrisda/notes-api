<?php
require 'UserSeed.php';
require 'NoteSeed.php';

class DatabaseSeeder
{
    public function run()
    {
        $userSeed = new UserSeed;
        $noteSeed = new NoteSeed;

        $userSeed->run();
        $noteSeed->run();
    }
}
