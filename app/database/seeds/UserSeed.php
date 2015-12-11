<?php
use App\Model\User;

class UserSeed
{
    public function run()
    {
        User::create([
            'name' => 'paul',
            'email' => 'paul@email.com',
            'password' => md5('paul')
        ]);

        User::create([
            'name' => 'john',
            'email' => 'john@email.com',
            'password' => md5('john')
        ]);
    }
}
